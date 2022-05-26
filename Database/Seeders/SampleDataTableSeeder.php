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
            $this->collection('Vitamins & Supplements', [
                $this->collection('CBD Oil & Capsules', [
                    $this->collection('Vitamins'),
                    $this->collection('Vitamin A'),
                    $this->collection('Vitamin B'),
                    $this->collection('Vitamin C'),
                    $this->collection('Vitamin D'),
                    $this->collection('Vitamin E'),
                    $this->collection('Multivitamins'),
                ]),
                $this->collection('Supplements', [
                    $this->collection('Apple Cider'),
                    $this->collection('Aloe Vera'),
                    $this->collection('Turmeric'),
                    $this->collection('Collagen & Silica'),
                    $this->collection('Omega & Fish Oils'),
                    $this->collection('Charcoal'),
                    $this->collection('Glucosamine'),
                    $this->collection('Evening Primrose Oil'),
                    $this->collection('Arnica'),
                    $this->collection('Garlic'),
                    $this->collection('Peppermint Oil'),
                    $this->collection('Acidophilus'),
                    $this->collection('Horny Goat Weed'),
                    $this->collection('5 HTP'),
                    $this->collection('Glucomannan'),
                ]),
                $this->collection('Minerals', [
                    $this->collection('Magnesium'),
                    $this->collection('Zinc'),
                    $this->collection('Iron'),
                    $this->collection('Calcium'),
                    $this->collection('Selenium'),
                    $this->collection('Chromium'),
                ]),
            ]),
            $this->collection('Food & Drink', [
                $this->collection('Teas', [
                    $this->collection('Fruit Tea'),
                    $this->collection('Green Tea'),
                    $this->collection('Herbal Tea'),
                    $this->collection('Peppermint Tea'),
                    $this->collection('Slimming Tea'),
                    $this->collection('Matcha Tea'),
                    $this->collection('Decaf Tea'),
                    $this->collection('Sleep & Relaxation Tea'),
                ]),
                $this->collection('Coffee & Coffee Alternatives', [
                    $this->collection('Bags'),
                    $this->collection('Instant'),
                    $this->collection('Decaf Coffee'),
                    $this->collection('Coffee Alternatives'),
                ]),
                $this->collection('Snacks', [
                    $this->collection('Chocolate, Cakes & Biscuits'),
                    $this->collection('Sugar Free Snacks'),
                    $this->collection('Raw Snacks'),
                    $this->collection('Crisps & Chips'),
                    $this->collection('Savoury Snacks'),
                    $this->collection('Snack Bars'),
                    $this->collection('Flapjacks'),
                    $this->collection('Sweet Snacks'),
                    $this->collection('World Food'),
                    $this->collection('Multipacks'),
                    $this->collection('Sharing Bags'),
                ]),
            ]),
            $this->collection('Sports Nutrition'),
            $this->collection('CBD'),
            $this->collection('Vegan'),
            $this->collection('Natural Beauty'),
            $this->collection('Weight Management'),
        ])->map(
            fn($payload) => $this->createCollections($payload)
        );
    }

    private function collection(string $name, array $children = []): array
    {
        return compact('name', 'children');
    }

    private function createCollections(array $payload, Collection $parent = null)
    {

        $collection = new Collection(['name' => $payload['name'] ?? '', 'collection_id' => $parent?->id]);

        $collection->save();

        $children = collect($payload['children'] ?? [])
            ->map(
                fn($child) => $this->createCollections($child, $collection)
            );

    }
}
