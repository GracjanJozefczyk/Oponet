<?php

namespace App\DataFixtures;

use App\Factory\TireBrandFactory;
use App\Factory\TireFuelEfficiencyFactory;
use App\Factory\TireHeightFactory;
use App\Factory\TireLoadIndexFactory;
use App\Factory\TireModelFactory;
use App\Factory\TireNoiseLevelFactory;
use App\Factory\TireProductFactory;
use App\Factory\TireRimSizeFactory;
use App\Factory\TireSpeedRatingFactory;
use App\Factory\TireWetGripFactory;
use App\Factory\TireWidthFactory;
use App\Factory\UserFactory;
use App\Factory\VehicleTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FeaturesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Create TireWidths
        foreach (range(125, 355, 10) as $width) {
            TireWidthFactory::createOne(['width' => $width]);
        }

        // Create TireHeights
        foreach (range(40, 80, 5) as $height) {
            TireHeightFactory::createOne(['height' => $height]);
        }

        // Create TireRimSizes
        foreach (range(13, 22) as $rimSize) {
            TireRimSizeFactory::createOne(['size' => $rimSize]);
        }

        // Create TireWetGrips
        foreach (range('A', 'F') as $wetGrip) {
            TireWetGripFactory::createOne(['wetGrip' => $wetGrip]);
        }

        // Create TireNoiseLevels
        foreach (range('A', 'C') as $noiseLevel) {
            TireNoiseLevelFactory::createOne(['noiseLevel' => $noiseLevel]);
        }

        // Create TireFuelEfficiencies
        foreach (range('A', 'F') as $fuelEfficiency) {
            TireFuelEfficiencyFactory::createOne(['fuelEfficiency' => $fuelEfficiency]);
        }

        // Create TireLoadIndexes
        $indexes = [];
        foreach (range(70, 126) as $index) {
            $indexes[] = $index;
        }
        $kgs = [335, 345, 355, 365, 375, 387, 400, 412, 425, 437, 450, 462, 475, 487, 500, 515, 530, 545, 560, 580, 600, 615, 630, 650, 670, 690, 710, 730, 750, 775, 800, 825, 850, 875, 900, 925, 950, 975, 1000, 1030, 1060, 1090, 1120, 1150, 1180, 1215, 1250, 1285, 1320, 1360, 1400, 1450, 1500, 1550, 1600, 1650, 1700];
        $lbs = [739, 761, 783, 805, 827, 853, 882, 908, 937, 963, 992, 1019, 1047, 1074, 1102, 1135, 1168, 1201, 1235, 1279, 1323, 1356, 1389, 1433, 1477, 1521, 1565, 1609, 1653, 1709, 1764, 1819, 1874, 1929, 1984, 2039, 2094, 2149, 2205, 2271, 2337, 2403, 2469, 2535, 2601, 2679, 2756, 2833, 2910, 2998, 3086, 3197, 3307, 3417, 3527, 3637, 3748];
        $i = 0;
        foreach ($indexes as $index) {
            TireLoadIndexFactory::createOne([
                'loadIndex' => $index,
                'kg' => $kgs[$i],
                'lbs' => $lbs[$i]
            ]);
            $i++;
        }

        // Create TireSpeedRatings
        $ratings = ["A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "Y"];
        $kmh = [5, 10, 15, 20, 25, 30, 35, 40, 50, 60, 65, 70, 80, 90, 210, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 240, 270, 300];
        $mph = [3, 6, 9, 12, 16, 19, 22, 25, 31, 37, 40, 43, 50, 56, 130, 62, 68, 75, 81, 87, 93, 99, 106, 112, 118, 124, 149, 168, 186];

        $j = 0;
        foreach ($ratings as $rating) {
            TireSpeedRatingFactory::createOne([
                'speedRating' => $rating,
                'kmh' => $kmh[$j],
                'mph' => $mph[$j]
            ]);
            $j++;
        }

        // Create VehicleTypes
        $types = ["car", "suv", "van", "truck"];
        foreach ($types as $type) {
            VehicleTypeFactory::createOne(['type' => $type]);
        }

        // Create brands
        TireBrandFactory::new()->createMany(5);

        // Create models
        TireModelFactory::new()->createMany(
            10,
            function () {
                return [
                    'brand' => TireBrandFactory::random(),
                    'vehicleType' => VehicleTypeFactory::random()
                ];
            }
        );

        // Create products
        TireProductFactory::createMany(
            50,
            function () {
                return [
                    'model' => TireModelFactory::random(),
                    'width' => TireWidthFactory::random(),
                    'height' => TireHeightFactory::random(),
                    'rimSize' => TireRimSizeFactory::random(),
                    'loadIndex' => TireLoadIndexFactory::random(),
                    'speedRating' => TireSpeedRatingFactory::random(),
                    'noiseLevel' => TireNoiseLevelFactory::random(),
                    'fuelEfficiency' => TireFuelEfficiencyFactory::random(),
                    'wetGrip' => TireWetGripFactory::random(),
                ];
            }
        );

        // Create admin user
        UserFactory::createOne([
            'email' => 'admin@oponet.pl',
            'roles' => ["ROLE_ADMIN"]
        ]);

        // Create manager user
        UserFactory::createOne([
            'email' => 'info@oponet.pl',
            'roles' => ["ROLE_MANAGER"]
        ]);

        // Create salesman user
        UserFactory::createOne([
            'email' => 'store@oponet.pl',
            'roles' => ["ROLE_SALESMAN"]
        ]);

        // Create warehouseman user
        UserFactory::createOne([
            'email' => 'warehouse@oponet.pl',
            'roles' => ["ROLE_WAREHOUSEMAN"]
        ]);

        // Create normal user
        UserFactory::createOne([
            'email' => 'user@oponet.pl',
        ]);
    }
}
