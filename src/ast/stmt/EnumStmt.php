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
namespace QuackCompiler\Ast\Stmt;

use \QuackCompiler\Parser\Parser;
use \QuackCompiler\Scope\Accessible;
use \QuackCompiler\Scope\Kind;
use \QuackCompiler\Scope\ScopeError;

class EnumStmt extends Stmt implements Accessible
{
    public $entries;
    public $name;

    public function __construct($name, $entries)
    {
        $this->name = $name;
        $this->entries = $entries;
    }

    public function format(Parser $parser)
    {
        $source = 'enum ';
        $source .= $this->name;
        $source .= PHP_EOL;

        $parser->openScope();

        foreach ($this->entries as $entry) {
            $source .= $parser->indent();
            $source .= $entry;
            $source .= PHP_EOL;
        }

        $parser->closeScope();

        $source .= $parser->indent();
        $source .= 'end';
        $source .= PHP_EOL;

        return $source;
    }

    public function injectScope(&$parent_scope)
    {
        $this->createScopeWithParent($parent_scope);

        // Inject its own members
        foreach ($this->entries as $entry) {
            if ($this->scope->hasLocal($entry)) {
                throw new ScopeError([
                    'message' => "Duplicated declaration of `{$entry}' for enum " .
                                 $this->name
                ]);
            }

            $this->scope->insert($entry, K_MEMBER);
        }
    }

    public function getMembers()
    {
        $members = [];

        foreach ($this->entries as $entry) {
            $members[$entry] = [
                'type' => $this->name
            ];
        }

        return $members;
    }
}
