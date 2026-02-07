<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Office::create([
            'title' => 'Head Quarter and Primary Office',
            'description' => "House-38, Level-5, Road-3B, Block-F, Sector-15, Uttara, Dhaka, Bangladesh.\nEmail: info@couturetexbd.com\nCEO: ceo@couturetexbd.com",
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Office::create([
            'title' => 'UK Sourcing Office',
            'description' => "129 Mile End Road, E1 4BG, London.\nUnited Kingdom.\nEmail: info.uk@couturetexbd.com\ninfo@couturetexbd.com",
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Office::create([
            'title' => 'Sweden Sourcing Office Sourcing Office',
            'description' => "Nebulosagatan 8, 415 63 Gothenburg.\nSweden\nEmail: sourcing.sweden@couturetexbd.com\ninfo@couturetexbd.com",
            'sort_order' => 3,
            'is_active' => true,
        ]);

        Office::create([
            'title' => 'Canada Sourcing Office',
            'description' => "205-191 Hollywood Road North, Kelowna, British Columbia, V1X 3R1, Canada.\nEmail: info.canada@couturetexbd.com\ninfo@couturetexbd.com",
            'sort_order' => 4,
            'is_active' => true,
        ]);

        Office::create([
            'title' => 'New Zealand Sourcing Office',
            'description' => "422 Memorial Avenue, Burnside, Christchurch 8053, New Zealand.\nEmail: info.nz@couturetexbd.com\ninfo@couturetexbd.com",
            'sort_order' => 5,
            'is_active' => true,
        ]);

        Office::create([
            'title' => 'China Fabric and Accessories Sourcing Office',
            'description' => "Flat-E, 15/F, Alpha House, 27-33 Nathan Road, Tsim Sha Tsui Kowloon, Hong Kong\nEmail: sourcing.china@couturetexbd.com\ninfo@couturetexbd.com",
            'sort_order' => 6,
            'is_active' => true,
        ]);
    }
}
