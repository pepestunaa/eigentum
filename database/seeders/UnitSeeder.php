<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Property;
use App\Models\Specification;
use App\Models\Status;
use App\Models\Unit;
use App\Models\UnitStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Unit::truncate();
        Image::truncate();
        Specification::truncate();
        UnitStatus::truncate();

        $propertyIds = Property::pluck('id')->toArray();

        $descriptions = [
            'Rumah dengan taman yang luas di depan dan belakang.',
            'Rumah dengan dua kamar tidur dan satu kamar mandi.',
            'Rumah minimalis dengan desain modern.',
            'Rumah dengan akses mudah ke pusat kota.',
            'Rumah dengan pemandangan pegunungan yang indah.',
        ];

        foreach ($propertyIds as $propertyId) {
            $numberOfUnits = rand(2, 5);
            $units = [];

            for ($i = 0; $i < $numberOfUnits; $i++) {
                $livingroomImages = $this->getImageUrls('livingroom', 3);
                $bedroomImages = $this->getImageUrls('bedroom', 3);
                $bathroomImages = $this->getImageUrls('bathroom', 3);
                $kitchenImages = $this->getImageUrls('kitchen', 3);
                $assetsImages = $this->getImageUrls('house', 3);

                $livingroomString = implode('|', $livingroomImages);
                $bedroomString = implode('|', $bedroomImages);
                $bathroomString = implode('|', $bathroomImages);
                $kitchenString = implode('|', $kitchenImages);
                $assetString = implode('|', $assetsImages); 
                $unit = Unit::create([
                    'title' => 'Unit ' . ($i + 1),
                    'description' => $descriptions[array_rand($descriptions)],
                    'price' => mt_rand(100, 999),
                    'image' => $this->getImageUrl('house'),
                    'statuscode' => 'tersedia',
                    'property_id' => $propertyId,
                ]);

                $units[] = $unit; // Simpan object unit untuk digunakan di hubungan many-to-many
            }

            $statuses = Status::pluck('id')->toArray();

            foreach ($units as $unit) {
                // Tentukan jumlah status yang akan dihubungkan (misalnya, antara 1 hingga 2 status)
                $numberOfStatuses = rand(1, 2);
    
                // Ambil status secara acak dari daftar status
                $randomStatuses = array_rand($statuses, $numberOfStatuses);
    
                // Jika hanya satu status yang diambil, konversi ke array agar dapat diiterasi
                if (!is_array($randomStatuses)) {
                    $randomStatuses = [$randomStatuses];
                }
    
                // Hubungkan unit dengan status menggunakan metode attach()
                foreach ($randomStatuses as $statusId) {
                    $unit->statuses()->attach($statuses[$statusId]);
                }
            }

            foreach ($units as $unit) {

                $image = Image::create([
                    'livingroomimg' => $livingroomString,
                    'bedroomimg' => $bedroomString,
                    'bathroomimg' => $bathroomString,
                    'kitchenimg' => $kitchenString,
                    'etcimg' => $assetString,
                    'unit_id' => $unit->id,
                ]);

                $unit->images()->save($image);

                Specification::create([
                    'bedroom' => fake()->randomNumber(1,5),
                    'bathroom' => fake()->randomNumber(1,5),
                    'surface_area' => fake()->randomNumber(1,999),
                    'building_area' => fake()->randomNumber(1,999),
                    'floor' => fake()->randomNumber(1,5),
                    'unit_id' => $unit->id,
                ]);
            }
        }
    }

    private $cachedFiles = [];

    private function getImageUrls($folderName, $count, $width = 400, $height = 300)
    {
        if (!isset($this->cachedFiles[$folderName])) {
            $this->cachedFiles[$folderName] = File::files(public_path($folderName));
        }

        $imageUrls = [];
        
        for ($i = 0; $i < $count; $i++) {
            $randomImagePath = Arr::random($this->cachedFiles[$folderName]);
            $imageName = $randomImagePath->getFilename();
            $imageUrls[] = $imageName;

            if (!Storage::exists('public/' . $imageName)) {
                Storage::putFileAs('public/', $randomImagePath->getRealPath(), $imageName);
            }
        }
        
        return $imageUrls;
    }

    private function getImageUrl($folderName, $width = 400, $height = 300)
    {
        return $this->getImageUrls($folderName, 1)[0];
    }

}
