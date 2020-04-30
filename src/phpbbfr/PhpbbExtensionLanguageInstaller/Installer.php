<?php

namespace phpbbfr\PhpbbExtensionLanguageInstaller;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        $name = explode('/', $package->getName())[1];

        if (!preg_match('#^([a-z0-9]+)-([a-z0-9]+)-language-(.+)$#', $name, $matches))
        {
            throw new \InvalidArgumentException('Invalid phpbb-extension-language composer package.');
        }

        $extension = isset($extra['phpbb-extension']) ? $extra['phpbb-extension'] : $matches[1] . '/' . $matches[2] ;
        $style = isset($extra['phpbb-language']) ? $extra['phpbb-language'] : $matches[3];

        return sprintf('ext/%s/language/%s', $extension, $style);
    }

    public function supports($packageType)
    {
        return $packageType == 'phpbb-extension-language';
    }
}
