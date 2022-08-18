<?php

namespace LibYear;

use GuzzleHttp\ClientInterface;

class Repository
{
	private string $url;
	private ?string $metadata_url;
	private array $available_packages;

	public function __construct(string $url, string $metadata_url, array $available_packages)
	{
		$this->url = $url;
		$this->metadata_url = $this->setMetadataUrl($metadata_url);
		$this->available_packages = $available_packages;
	}

	private function setMetadataUrl(?string $url): ?string
	{
		return str_replace(['/internal/', '/external/'], '', $url);
	}

	public function hasPackage(string $package): bool
	{
		return empty($this->available_packages) || in_array($package, $this->available_packages);
	}

	public function getPackageUrl(string $package): string
	{
		return $this->url.str_replace('%package%', $package, $this->metadata_url);
	}
}
