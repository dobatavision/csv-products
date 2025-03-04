<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_file_upload()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        if ($user instanceof Authenticatable) {
            echo "Authenticated";
        }else{
            echo "Not Authenticated";
        }
        // var_dump($user);


        // dd($user);
        // Create a CSV file programmatically
        $csvContent = "name,description,price\nProduct 1,Description 1,10.00\nProduct 2,Description 2,20.00";
        // Storage::disk('public')->put('uploads/test_products.csv', $csvContent);

        // if ($is_saved) {
        //     echo "File saved";
        // }else{
        //     echo "File not saved";
        // }
        $file = UploadedFile::fake()->createWithContent('products.csv', $csvContent);
// dd($file);
        $response = $this->actingAs($user)->post('/api/upload', [
            'file' => $file,
        ]);
        // dd($response);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'File uploaded and will be imported from Queue process !!!']);

        Storage::assertExists('uploads/products.csv');
    }

//     public function test_list_products()
//     {
//         $user = User::factory()->create();
// // var_dump($user->id);
//         Product::factory()->count(15)->create(['user_id' => $user->id]);

//         $response = $this->actingAs($user, 'sanctum')->get('/api/products');

//         $response->assertStatus(200);
//         $response->assertJsonStructure([
//             'data' => [
//                 '*' => ['id', 'name', 'description', 'price', 'user_id', 'created_at', 'updated_at'],
//             ],
//             'links',
//             'meta',
//         ]);
//     }
}
