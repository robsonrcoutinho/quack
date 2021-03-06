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

use \QuackCompiler\Parser\Parser;
use \QuackCompiler\Types\NativeQuackType;
use \QuackCompiler\Types\Type;

class NumberExpr extends Expr
{
    public $value;
    public $type;

    public function __construct($value, $type)
    {
        $this->value = $value;
        $this->type = $type;
    }

    public function format(Parser $parser)
    {
        $source = $this->value;
        return $this->parenthesize($source);
    }

    public function injectScope(&$parent_scope)
    {
        // Pass
    }

    public function getType()
    {
        switch ($this->type) {
            case 'int':
                return new Type(NativeQuackType::T_INT);
            case 'double':
                return new Type(NativeQuackType::T_DOUBLE);
            default:
                return new Type(null);
        }
    }
}
