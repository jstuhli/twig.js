<?php

/*
 * Copyright 2011 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace TwigJs\Compiler;

use TwigJs\JsCompiler;
use TwigJs\TypeCompilerInterface;

class InlinePrintCompiler implements TypeCompilerInterface
{
    public function getType()
    {
        return 'Twig\Node\Expression\InlinePrint';
    }

    public function compile(JsCompiler $compiler, \Twig_NodeInterface $node)
    {
        if (!$node instanceof \Twig\Node\Expression\InlinePrint) {
            throw new \RuntimeException(
                sprintf(
                    '$node must be an instanceof of \Twig\Node\Expression\InlinePrint, but got "%s".',
                    get_class($node)
                )
            );
        }

        $compiler
            ->addDebugInfo($node)
            ->write('sb.append(')
            ->subcompile($node->getNode('node'))
            ->raw(")")
        ;
    }
}
