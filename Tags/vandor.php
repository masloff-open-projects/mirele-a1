<?php

use Mirele\Compound\Tag;
use Mirele\Compound\TagsManager;

$Tag_ = new Tag();
$Tag_->setTag('template');
$Tag_->setEssence('');
$Tag_->setReference('\Mirele\Compound\Component');

TagsManager::add($Tag_);


$Tag = new Tag();
$Tag->setTag('component');
$Tag->setEssence('');
$Tag->setReference('\Mirele\Compound\Component');

TagsManager::add($Tag);


$Tag__ = new Tag();
$Tag__->setTag('field');
$Tag__->setEssence('');
$Tag__->setReference('\Mirele\Compound\Component');

TagsManager::add($Tag__);