<?php
/*
 * Copyright (c) 2021.
 * Chibilyaev Alexandr
 * info@aachibilyaev.com
 * https://aachibilyaev.com
 */

namespace aachibilyaev\phpramcache;

/**
 * Class Phpramcache
 *
 * @package aachibilyaev\phpramcache
 */
class Phpramcache
{
		/**
		 * @var string
		 */
		private $ramFilesPath = '';

		/**
		 * Ramcache constructor.
		 *
		 * @param string $ramFilesPath
		 */
		public function __construct($ramFilesPath = '/tmp/') { $this->setRamFilesPath($ramFilesPath); }

		/**
		 * @param $key
		 * @param $val
		 */
		public function setStorage($key, $val)
		{
				$val = var_export($val, true);
				$val = str_replace('stdClass::__set_state', '(object)', $val);
				$tmp = $this->getRamFilesPath() . $key . uniqid('', true) . '.tmp';
				file_put_contents($tmp, '<?php $val = ' . $val . ';', LOCK_EX);
				rename($tmp, $this->getRamFilesPath() . $key);
				unset($val);
				unset($tmp);
		}

		/**
		 * @return string
		 */
		public function getRamFilesPath()
		{
				return $this->ramFilesPath;
		}

		/**
		 * @param string $ramFilesPath
		 */
		public function setRamFilesPath($ramFilesPath)
		{
				$this->ramFilesPath = $ramFilesPath;
		}

		/**
		 * @param $key
		 *
		 * @return false|mixed
		 */
		public function getStorage($key)
		{
				@include $this->getRamFilesPath() . $key;
				return isset($val) ? $val : false;
		}
}