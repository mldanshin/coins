<?php

namespace App\Models\Download\Document;

use App\Models\Download\Repository;
use App\Models\Download\Document\Picture\Picture;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use FPDF\FPDF;

final class CreatorPdf extends CreatorBase
{
    private FPDF $pdf;
    private string $fileName = "coins.pdf";
    private string $filePath;
    private int $heightCell;
    private mixed $leftMarginPage;

    /**
     * @param Collection<Coin> $coins
     */
    public function __construct(
        Repository $repository,
        Collection $coins
    ) {
        parent::__construct($repository, $coins);

        $this->initializePath();
        $this->createFile();
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    private function initializePath(): void
    {
        $this->filePath = $this->repository->getPath($this->fileName);
    }

    private function createFile(): void
    {
        $this->pdf = new FPDF();
        $this->pdf->AddFont("arial", "", "arial.php");
        $this->pdf->AddFont("arial_bold", "", "arial_bold.php");
        $this->heightCell = 5;
        $this->setFontDefault();
        $this->pdf->AddPage();
        $this->leftMarginPage = $this->pdf->GetX();

        foreach ($this->coins as $coin) {
            $this->createCard($coin);
        }

        $this->pdf->Output($this->filePath, "F");
    }

    private function createCard(Coin $coin): void
    {
        $this->createCellStrong(
            __("coin.name") . " " . $coin->title->nominal . " " . $coin->title->currency . " " . $coin->title->year
        );
        $this->pdf->Ln();

        $this->insertPictures($coin->picture);

        $this->createCell(__("coin.country"), $coin->country);
        $this->createCell(__("coin.nominal"), $coin->nominal);
        $this->createCell(__("coin.coinage"), $coin->coinage);
        $this->createCell(__("coin.material"), $coin->material);
        $this->createCell(__("coin.currency"), $coin->currency);
        $this->createCell(__("coin.shape"), $coin->shape);
        $this->createCell(__("coin.theme"), $coin->theme);

        if ($coin->mintmark !== null) {
            $this->createCell(__("coin.mintmark"), $coin->mintmark);
        }

        $this->createCell(__("coin.year"), $coin->year);
        $this->createCell(__("coin.quality"), $coin->quality);
        $this->createCell(__("coin.storage"), $coin->storage);

        $this->pdf->Ln();
        $this->pdf->Ln();
    }

    private function createCellStrong(string $value): void
    {
        $this->pdf->SetFont("arial_bold", "", 14);
        $this->pdf->Cell(20, $this->heightCell, $value);
        $this->pdf->Ln();
        $this->setFontDefault();
    }

    private function createCell(string $label, ?string $value): void
    {
        $this->pdf->MultiCell(360, $this->heightCell, $label . ": " . $value, align: "L");
    }

    private function setFontDefault(): void
    {
        $this->pdf->SetFont("arial", "", 12);
    }

    private function insertPictures(Picture $picture): void
    {
        if ($picture->obverse === null && $picture->reverse === null) {
            return;
        }

        if (
            ($picture->obverse !== null && $this->validatePictureFile($picture->obverse) === false) &&
            ($picture->reverse !== null && $this->validatePictureFile($picture->reverse) === false)
        ) {
            return;
        }

        $x = 0;
        $y = 0;
        $width = 30;
        $maxHeight = 40;
        $marginBottom = 5;

        $this->insertPicture($picture->obverse, $x, $y, $width, $maxHeight, $marginBottom);
        $this->insertPicture($picture->reverse, $x, $y, $width, $maxHeight, $marginBottom);

        $this->pdf->SetXY($this->leftMarginPage, $y + 40);
    }

    private function insertPicture(
        ?string $path,
        int &$x,
        int &$y,
        int $width,
        int $maxHeight,
        int $marginBottom
    ): void {
        if ($x === 0) {
            $x = $this->pdf->GetX();
            $y = $this->pdf->GetY();
        } else {
            $x += $this->pdf->GetX() + $width;
            if (($x + $width) > $this->pdf->GetPageWidth()) {
                $x = $this->leftMarginPage;
                $y = $this->pdf->GetY() + $maxHeight + $marginBottom;
            } else {
                $y = $this->pdf->GetY();
            }
        }

        if ($this->pdf->GetPageHeight() < ($y + $maxHeight)) {
            $this->pdf->AddPage();
            $x = $this->pdf->GetX();
            $y = $this->pdf->GetY();
        }

        if ($path !== null && $this->validatePictureFile($path)) {
            $this->pdf->Image(
                $path,
                x: $x,
                y: $y,
                w: $width
            );
        }
    }

    private function validatePictureFile(string $path): bool
    {
        $extension = File::extension($path);
        if (in_array($extension, $this->allowableExtension())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array<string>
     */
    private function allowableExtension(): array
    {
        return [
            "jpg",
            "jpeg",
            "png",
            "gif"
        ];
    }
}
