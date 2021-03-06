<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusVendorPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

final class VendorContext implements Context
{
    /**
     * @var RepositoryInterface
     */
    private $vendorRepository;

    /**
     * @param RepositoryInterface $vendorRepository
     */
    public function __construct(
        RepositoryInterface $vendorRepository
    ) {
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * @Transform /^vendor "([^"]+)"$/
     * @Transform /^"([^"]+)" vendor$/
     */
    public function getVendorByName($vendorName)
    {
        $vendor = $this->vendorRepository->findOneBy(['name' => $vendorName]);

        Assert::notNull(
            $vendor,
            'Vendor with name %s does not exist'
        );

        return $vendor;
    }
}
