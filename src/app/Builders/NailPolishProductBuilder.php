<?php
namespace App\Builders;

use App\Models\NailPolishProduct;

class NailPolishProductBuilder
{
    protected $data = [];

    public function setName(string $name): self
    {
        $this->data['name'] = $name;
        return $this;
    }

    public function setCode(string $code): self
    {
        $this->data['code'] = $code;
        return $this;
    }

    public function setBrandId(?int $brandId): self
    {
        $this->data['brand_id'] = $brandId;
        return $this;
    }

    public function setCategoryId(?int $categoryId): self
    {
        $this->data['category_id'] = $categoryId;
        return $this;
    }

    public function setColorCode(?string $colorCode): self
    {
        $this->data['color_code'] = $colorCode;
        return $this;
    }

    public function setColorName(?string $colorName): self
    {
        $this->data['color_name'] = $colorName;
        return $this;
    }

    public function setHexColor(?string $hexColor): self
    {
        $this->data['hex_color'] = $hexColor;
        return $this;
    }

    public function setFinishType(?string $finishType): self
    {
        $this->data['finish_type'] = $finishType;
        return $this;
    }

    public function setVolumeMl(?float $volumeMl): self
    {
        $this->data['volume_ml'] = $volumeMl;
        return $this;
    }

    public function setDryTimeSeconds(?int $dryTimeSeconds): self
    {
        $this->data['dry_time_seconds'] = $dryTimeSeconds;
        return $this;
    }

    public function setDurabilityDays(?int $durabilityDays): self
    {
        $this->data['durability_days'] = $durabilityDays;
        return $this;
    }

    public function setIsVegan(bool $isVegan): self
    {
        $this->data['is_vegan'] = $isVegan;
        return $this;
    }

    public function setIsCrueltyFree(bool $isCrueltyFree): self
    {
        $this->data['is_cruelty_free'] = $isCrueltyFree;
        return $this;
    }

    public function setIsToxicFree(bool $isToxicFree): self
    {
        $this->data['is_toxic_free'] = $isToxicFree;
        return $this;
    }

    public function setPriceVnd(?int $priceVnd): self
    {
        $this->data['price_vnd'] = $priceVnd;
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->data['currency'] = $currency;
        return $this;
    }

    public function setManufactureDate(?string $manufactureDate): self
    {
        $this->data['manufacture_date'] = $manufactureDate;
        return $this;
    }

    public function setExpiryDate(?string $expiryDate): self
    {
        $this->data['expiry_date'] = $expiryDate;
        return $this;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->data['barcode'] = $barcode;
        return $this;
    }

    public function setUsageInstructions(?string $usageInstructions): self
    {
        $this->data['usage_instructions'] = $usageInstructions;
        return $this;
    }

    public function setWarningNotes(?string $warningNotes): self
    {
        $this->data['warning_notes'] = $warningNotes;
        return $this;
    }

    public function setStorageInstructions(?string $storageInstructions): self
    {
        $this->data['storage_instructions'] = $storageInstructions;
        return $this;
    }

    // Xây dựng model từ data hiện tại
    public function build(): NailPolishProduct
    {
        return new NailPolishProduct($this->data);
    }
}
