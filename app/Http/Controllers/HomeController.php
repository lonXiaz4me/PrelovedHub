<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private const CATEGORIES = ['For you', 'Clothing', 'Home', 'Accessories', 'Electronics'];

    public function __invoke(Request $request): View
    {
        $activeCategory = in_array($request->query('category'), self::CATEGORIES, true)
            ? $request->query('category')
            : 'For you';

        $q = trim((string) $request->query('q', ''));

        // Temporary sample data. Replace with an Eloquent query once the Item model exists.
        $all = collect($this->sampleListings());

        $listings = $all
            ->when($activeCategory !== 'For you', fn ($items) => $items->where('category', $activeCategory))
            ->when($q !== '', fn ($items) => $items->filter(
                fn ($item) => str_contains(mb_strtolower($item['title']), mb_strtolower($q))
            ))
            ->values();

        return view('home', [
            'categories' => self::CATEGORIES,
            'activeCategory' => $activeCategory,
            'q' => $q,
            'listings' => $listings,
            'featured' => $all->first(),
        ]);
    }

    private function sampleListings(): array
    {
        return [
            [
                'id' => 1, 'title' => 'Vintage leather shoulder bag', 'price' => 'RM 48', 'category' => 'Accessories',
                'condition' => 'Great condition', 'location' => 'Kajang, Selangor', 'seller' => "Maya's archive", 'initials' => 'MA',
                'image' => 'https://images.unsplash.com/photo-1697909624356-c98d29afe5b6?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-sage',
            ],
            [
                'id' => 2, 'title' => 'Linen summer co-ord set', 'price' => 'RM 32', 'category' => 'Clothing',
                'condition' => 'Like new', 'location' => 'Johor Bahru, Johor', 'seller' => 'By Jules', 'initials' => 'BJ',
                'image' => 'https://images.unsplash.com/photo-1453486030486-0a5ffcd82cd9?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-coral-soft',
            ],
            [
                'id' => 3, 'title' => 'Amber glass table lamp', 'price' => 'RM 65', 'category' => 'Home',
                'condition' => 'Good condition', 'location' => 'George Town, Penang', 'seller' => 'Sunday Objects', 'initials' => 'SO',
                'image' => 'https://images.unsplash.com/photo-1688126753535-0ca32e3b5cbb?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-gold-soft', 'liked' => true,
            ],
            [
                'id' => 4, 'title' => 'Classic wool overshirt', 'price' => 'RM 54', 'category' => 'Clothing',
                'condition' => 'Great condition', 'location' => 'Petaling Jaya, Selangor', 'seller' => 'Common Thread', 'initials' => 'CT',
                'image' => 'https://images.unsplash.com/photo-1714583353759-ac534aae73ce?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-blue-soft',
            ],
            [
                'id' => 5, 'title' => 'Curated vintage trinket set', 'price' => 'RM 28', 'category' => 'Home',
                'condition' => 'Good condition', 'location' => 'Ipoh, Perak', 'seller' => 'Found & Kept', 'initials' => 'FK',
                'image' => 'https://images.unsplash.com/photo-1474666488182-66ec723476c6?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-lilac-soft',
            ],
            [
                'id' => 6, 'title' => 'Retro printed weekend shirt', 'price' => 'RM 39', 'category' => 'Clothing',
                'condition' => 'Like new', 'location' => 'Kuching, Sarawak', 'seller' => 'Second Story', 'initials' => 'SS',
                'image' => 'https://images.unsplash.com/photo-1756659550646-6f2e29da00c3?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&q=82&w=900',
                'accent' => 'bg-mint-soft',
            ],
        ];
    }
}
