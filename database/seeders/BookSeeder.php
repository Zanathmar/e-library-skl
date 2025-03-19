<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define available categories
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science',
            'Technology',
            'History',
            'Biography',
            'Self-Help',
            'Other'
        ];
        
        // Create storage directory if it doesn't exist
        $storagePath = storage_path('app/public/book-images');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0755, true);
        }
        
        // Copy placeholder images from resources to storage
        $this->copyPlaceholderImages();
        
        // Get all available book cover images
        $bookCovers = File::files($storagePath);
        $coverFileNames = [];
        
        foreach ($bookCovers as $cover) {
            $coverFileNames[] = basename($cover);
        }
        
        // If no images found, create books without covers but with categories
        if (empty($coverFileNames)) {
            Book::factory(40)->make()->each(function ($book) use ($categories) {
                $book->category = $categories[array_rand($categories)];
                $book->save();
            });
            return;
        }
        
        // Create 40 books with real cover images and categories
        Book::factory(40)->make()->each(function ($book) use ($coverFileNames, $categories) {
            // Assign a random cover image from the available ones
            $book->image = $coverFileNames[array_rand($coverFileNames)];
            
            // Assign a random category
            $book->category = $categories[array_rand($categories)];
            
            $book->save();
        });
    }
    
    /**
     * Copy placeholder book covers from resources to storage.
     * You'll need to create these images in resources/placeholder-covers/ first.
     */
    private function copyPlaceholderImages(): void
    {
        $sourcePath = resource_path('placeholder-covers');
        $destinationPath = storage_path('app/public/book-images');
        
        // If placeholder covers directory doesn't exist, generate some placeholder images
        if (!File::exists($sourcePath)) {
            $this->generatePlaceholderImages($destinationPath);
            return;
        }
        
        // Copy all placeholder images to storage
        $placeholderImages = File::files($sourcePath);
        foreach ($placeholderImages as $image) {
            $filename = basename($image);
            File::copy($image, $destinationPath . '/' . $filename);
        }
    }
    
    /**
     * Generate placeholder images if none exist.
     * This creates 10 colored rectangles with text as basic book covers.
     */
    private function generatePlaceholderImages($destinationPath): void
    {
        $colors = ['#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6', 
                  '#1abc9c', '#d35400', '#34495e', '#7f8c8d', '#c0392b'];
        
        for ($i = 1; $i <= 10; $i++) {
            // Create a placeholder image
            $img = imagecreatetruecolor(300, 450);
            
            // Set background color
            $colorHex = $colors[$i % count($colors)];
            $r = hexdec(substr($colorHex, 1, 2));
            $g = hexdec(substr($colorHex, 3, 2));
            $b = hexdec(substr($colorHex, 5, 2));
            $color = imagecolorallocate($img, $r, $g, $b);
            imagefill($img, 0, 0, $color);
            
            // Add text
            $white = imagecolorallocate($img, 255, 255, 255);
            $text = "Book Cover {$i}";
            $font = 5; // Built-in font size
            $fontWidth = imagefontwidth($font);
            $fontHeight = imagefontheight($font);
            $textWidth = $fontWidth * strlen($text);
            
            // Center the text
            $x = (imagesx($img) - $textWidth) / 2;
            $y = (imagesy($img) / 2) - ($fontHeight / 2);
            
            imagestring($img, $font, $x, $y, $text, $white);
            
            // Save the image
            imagepng($img, $destinationPath . "/book-cover-{$i}.png");
            imagedestroy($img);
        }
    }
}