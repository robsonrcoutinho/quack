<?php
/**
 * Quack Compiler and toolkit
 * Copyright (C) 2016 Marcelo Camargo <marcelocamargo@linuxmail.org> and
 * CONTRIBUTORS.
 *
 * This file is part of Quack.
 *
 * Quack is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Quack is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Quack.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace QuackCompiler\Ast\Expr;

use \QuackCompiler\Parselets\FunctionParselet;
use \QuackCompiler\Parser\Parser;
use \QuackCompiler\Scope\Kind;
use \QuackCompiler\Scope\ScopeError;

class LambdaExpr extends Expr
{
    public $by_reference;
    public $parameters;
    public $type;
    public $body;
    public $lexical_vars;

    public function __construct($by_reference, $parameters, $type, $body, $lexical_vars)
    {
        $this->by_reference = $by_reference;
        $this->parameters = $parameters;
        $this->type = $type;
        $this->body = $body;
        $this->lexical_vars = $lexical_vars;
    }

    public function format(Parser $parser)
    {
        $source = 'fn ';

        if ($this->by_reference) {
            $source .= '* ';
        }

        $source .= '{ ';

        $source .= implode('; ', array_map(function ($param) {
            $obj = (object) $param;

            $source = '';
            $obj->ellipsis && $source .= '... ';
            $obj->by_reference && $source .= '*';
            $source .= $obj->name;
            return $source;
        }, $this->parameters));

        $source .= 'fn { ' !== $source ? ' |' : '|';

        if (FunctionParselet::TYPE_EXPRESSION === $this->type) {
            $source .= ' ';
            $source .= $this->body->format($parser);
            $source .= ' ';
        } else {
            $source .= PHP_EOL;

            $parser->openScope();

            $source .= $parser->indent();
            $source .= 'begin';
            $source .= PHP_EOL;

            $parser->openScope();

            foreach ($this->body as $stmt) {
                $source .= $parser->indent();
                $source .= $stmt->format($parser);
            }

            $parser->closeScope();

            $source .= $parser->indent();
            $source .= 'end';
            $source .= PHP_EOL;

            $parser->closeScope();

            $source .= $parser->indent();
        }

        $source .= '}';

        $size_t_lexical_vars = sizeof($this->lexical_vars);

        if ($size_t_lexical_vars > 0) {
            $source .= ' in ';
            $source .= 1 === $size_t_lexical_vars
                ? $this->lexical_vars[0]
                : (
                    '{ ' .
                    implode('; ', $this->lexical_vars) .
                    ' }'
                );
        }

        return $this->parenthesize($source);
    }

    public function injectScope(&$parent_scope)
    {
        $this->createScopeWithParent($parent_scope);

        foreach (array_map(function ($item) {
            return (object) $item;
        }, $this->parameters) as $param) {
            if ($this->scope->hasLocal($param->name)) {
                throw new ScopeError([
                    'message' => "Duplicated parameter `{$param->name}' in anonymous function"
                ]);
            }

            $this->scope->insert($param->name, Kind::K_INITIALIZED | Kind::K_VARIABLE | Kind::K_PARAMETER | Kind::K_MUTABLE);
        }

        if (FunctionParselet::TYPE_STATEMENT === $this->type) {
            $this->bindDeclarations($this->body);

            foreach ($this->body as $node) {
                $node->injectScope($this->scope);
            }
        } else {
            $this->body->injectScope($this->scope);
        }
    }
}
