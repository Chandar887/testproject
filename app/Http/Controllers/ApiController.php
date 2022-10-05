<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\NewsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function index()
    {
        $endpoint = 'https://newsapi.org/v2/everything?q=apple&from=2022-09-18&to=2022-09-18&sortBy=popularity&apiKey=90b85e2c2ddc4d888b86b7f8a9807060';

        $client = new Client;
        $response = $client->request('GET', $endpoint);
        
        if ($response->getStatusCode() == 200) {
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            
            if (!empty($data)) {
                # Creating News Api
                $newsApi = NewsApi::create([
                    'endpoint'      => $endpoint,
                    'total_results' => $data->totalResults,
                ]);

                if ($newsApi) {
                    $dataArr = [];
                    foreach ($data->articles as $article) {
                        $source = $article->source; // Getting source
                        $dataArr[] = [
                            'news_api_id' => $newsApi->id,
                            'source_id'   => ($source && $source->id !== null) ? $source->id : '',
                            'source_name' => ($source && $source->name !== '') ? $source->name : '',
                            'author'      => $article->author,
                            'title'       => $article->title,
                            'description' => $article->description,
                            'url'         => $article->url,
                            'urlToImage'  => $article->urlToImage,
                            'publishedAt' => $article->publishedAt,
                            'content'     => $article->content,
                            'created_at'  => Carbon::now(),
                            'updated_at'  => Carbon::now()
                        ];
                    }

                    if (count($dataArr) > 0) {
                        # Saving articles
                        DB::table('articles')->insert($dataArr);

                        session()->flash('message', 'Api response saved successfully.');
                    }
                }
            } else {
                session()->flash('error', 'Something went wrong, Please try again.');
            }
        } else {
            session()->flash('error', 'Something went wrong, Please try again.');
        }

        return redirect('/');
    }
}
