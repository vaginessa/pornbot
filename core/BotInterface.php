<?php
namespace PornBOT;

interface BotInterface
{
	public function name();
	public function type();
	public function url();
	public function title();
	public function duration();
	public function thumbnail();
	public function link();
}