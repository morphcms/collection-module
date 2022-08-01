<?php

namespace Modules\Collection\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Collection\Models\Collection;

class SampleDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        collect([
            $this->collection('Desktops, Laptops & Mobile Devices', [
                $this->collection('Desktops & Monitors', [
                    $this->collection('Desktop PC'),
                    $this->collection('Gaming PC'),
                    $this->collection('Office PC'),
                    $this->collection('MacOs'),
                    $this->collection('Monitor'),
                ]),

                $this->collection('Laptops & Accessories', [
                    $this->collection('Gaming Laptops'),
                    $this->collection('Office Laptops'),
                    $this->collection('Home Laptops'),
                    $this->collection('Accessories'),

                ]),
                $this->collection('Mobile Devices', [
                    $this->collection('Mobile'),
                    $this->collection('Tablets'),
                    $this->collection('Smart Watches'),
                    $this->collection('Fitness Bracelets'),
                ]),

                $this->collection('Accessories', [
                    $this->collection('Laptop Bags'),
                    $this->collection('Coolers'),
                    $this->collection('Headphones'),

                ]),
            ]),
            $this->collection('Fashion', [
                $this->collection('Men', [
                    $this->collection('T-Shirts'),
                    $this->collection('Shoes'),
                    $this->collection('Jeans'),
                    $this->collection('Shirts'),
                ]),

                $this->collection('Women', [
                    $this->collection('Dresses'),
                    $this->collection('Skirts'),
                    $this->collection('T-Shirts'),
                    $this->collection('Pants'),
                    $this->collection('Shoes'),
                    $this->collection('Bags'),
                ]),

                $this->collection('Kids', [
                    $this->collection('T-Shirts'),
                    $this->collection('Shoes'),
                    $this->collection('Jeans'),
                    $this->collection('Shirts'),
                ]),

                $this->collection('Accessories', [
                    $this->collection('Watch'),
                    $this->collection('Jewelery'),
                    $this->collection('Sunglasses'),
                    $this->collection('Backpacks'),
                ]),
            ]),

        ])->map(
            fn ($payload) => $this->createCollections($payload)
        );
    }

    protected function collection(string $name, array $children = []): array
    {
        return compact('name', 'children');
    }

    protected function createCollections(array $payload, Collection $parent = null)
    {
        $collection = new Collection(['name' => $payload['name'] ?? '', 'collection_id' => $parent?->id]);

        $collection->save();

        $children = collect($payload['children'] ?? [])
            ->map(
                fn ($child) => $this->createCollections($child, $collection)
            );
    }
}
