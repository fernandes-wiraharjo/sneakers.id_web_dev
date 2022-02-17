<?php
namespace App\Services;

use Illuminate\Http\Request;
use Modules\LookBook\Repositories\LookBookRepository;
use Carbon\Carbon;

class LookBookService {
    public function __construct(LookBookRepository $lookbookRepository) {
        $this->lookbookRepository = $lookbookRepository;
    }

	public function insertLookBook($request){
        $lookbook = [
            'look_book_title' => $request['look_book_title'],
            'look_book_description' => $request['look_book_description'],
            'look_book_content' => $request['look_book_content'],
            'look_book_order' => $request['look_book_order'],
            'is_active' => $request['is_active']
        ];

        $insertedLookBook = $this->lookbookRepository->createLookBook($lookbook);

        if($insertedLookBook) {
            $idNewLookBook = $insertedLookBook->id;

            $path = 'images/lookbook';

            if(isset($request['lookbook_image'])){
                $no = 1;

                foreach($request['lookbook_image'] as $image){

                    $do_upload = imageUpload($image, $path ,'public', true, $no);

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $lookbookImage = [
                            'look_book_id' => $idNewLookBook,
                            'image_url' => $do_upload
                        ];

                        $this->lookbookRepository->insertLookBookImage($lookbookImage);
                    }

                    $no++;
                }
            }

            if (isset($request['lookbook'])){
                $no = 1;

                foreach($request['lookbook'] as $card){

                    $do_upload = imageUpload($card['image'], $path ,'public', true, $no, 'card');

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $lookbookCard = [
                            'look_book_id' => $idNewLookBook,
                            'look_book_card_title' => $card['look_book_card_title'],
                            'look_book_card_url' => $card['look_book_card_url'],
                            'look_book_card_description' => $card['look_book_card_description'],
                            'is_active' => intval(isset($card['is_active']) ? $card['is_active'][0] : 0),
                            'image_url' => $do_upload
                        ];

                        $this->lookbookRepository->insertLookBookCard($lookbookCard);
                    }

                    $no++;
                }
            }

            return true;
        }
	}

    public function updateLookBook($id, $request){
        $lookbook = [
            'look_book_title' => $request['look_book_title'],
            'look_book_description' => $request['look_book_description'],
            'look_book_content' => $request['look_book_content'],
            'look_book_order' => $request['look_book_order'],
            'is_active' => $request['is_active']
        ];

        $getLookBook = $this->lookbookRepository->getLookBookById($id);

        $insertedLookBook = $getLookBook->update($lookbook);

        if($insertedLookBook) {
            $path = 'images/lookbook';

            if(isset($request['lookbook_image'])){
                $no = 1;

                $this->lookbookRepository->deleteLookBookImage($id);

                foreach($request['lookbook_image'] as $image){

                    $do_upload = imageUpload($image, $path ,'public', true, $no);

                    if(!$do_upload){
                        abort(500, 'Failed upload image');
                    } else {
                        $lookbookImage = [
                            'look_book_id' => $id,
                            'image_url' => $do_upload
                        ];

                        $this->lookbookRepository->insertLookBookImage($lookbookImage);
                    }

                    $no++;
                }
            }

            if (isset($request['lookbook'])){
                $no = 1;

                $this->lookbookRepository->deleteLookBookCard($id);

                foreach($request['lookbook'] as $card){

                    if(isset($card['image'])) {
                        $do_upload = imageUpload($card['image'], $path ,'public', true, $no, 'card');

                        if(!$do_upload){
                            abort(500, 'Failed upload image');
                        } else {
                            $lookbookCard = [
                                'look_book_id' => $id,
                                'look_book_card_title' => $card['look_book_card_title'],
                                'look_book_card_url' => $card['look_book_card_url'],
                                'look_book_card_description' => $card['look_book_card_description'],
                                'is_active' => intval(isset($card['is_active']) ? $card['is_active'][0] : 0),
                                'image_url' => $do_upload
                            ];

                            $this->lookbookRepository->insertLookBookCard($lookbookCard);
                        }

                        $no++;
                    } else {
                        $lookbookCard = [
                            'look_book_id' => $id,
                            'look_book_card_title' => $card['look_book_card_title'],
                            'look_book_card_url' => $card['look_book_card_url'],
                            'look_book_card_description' => $card['look_book_card_description'],
                            'is_active' => intval(isset($card['is_active']) ? $card['is_active'][0] : 0),
                            'image_url' => $do_upload
                        ];

                        $this->lookbookRepository->insertLookBookCard($lookbookCard);
                    }
                }
            }

            return true;
        }
    }
}
