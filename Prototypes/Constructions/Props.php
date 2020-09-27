<?php

namespace Mirele\Compound\Children;


use Mirele\Compound\Constructor;
use Mirele\Compound\Construction;
use Mirele\Compound\Directive;
use Mirele\Compound\Tag;
use Mirele\Compound\TagsManager;
use Mirele\Framework\Buffer;


$Construction = new Construction();
$Construction->setName('props');
$Construction->setHandler(function ($root) {

    if (isset($root) and (is_object($root) or is_array($root))) {

        $Buffer = new Buffer();

        foreach ($root as $directive) {

            if ($directive instanceof Directive) {

                $Tag = TagsManager::get($directive->getTag());

                if ($Tag instanceof Tag) {
                    $Tag->setAttributes($directive->getAttributes());
                    $Buffer->append($Tag);
                }


            }

        }

        return $Buffer->getBuffer();

    }

});

Constructor::add($Construction);

