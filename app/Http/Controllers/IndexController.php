<?php
/**
 * IndexController.php
 * User: Joe
 * Date: 2023/8/21
 * Time: 13:50
 */
namespace App\Http\Controllers;

use App\Model\Book;
use App\Model\Author;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Press;

class IndexController extends BaseController {
    public function index() {
        $hot_recommend_res = Book::getHotRecommend();
        $new_book_recommend_res = Book::getNewBookRecommend();
        $carousel = Book::getCarousel();
        return view('index', [
            'hot_recommend_res' => $hot_recommend_res,
            'new_book_recommend_res' => $new_book_recommend_res,
            'carousel' => $carousel
        ]);
    }

    public function search() {
        $keyword = request('keyword',  '');
        $search_list = Book::getSearchListByKeyword($keyword);
        return view('search', [
            'keyword' => $keyword,
            'search_list' => $search_list,
        ]);
    }

    public function book_detail($id) {
        $id = explode(',', $id)[0];
        $book = Book::getBookByID($id);

        $recommended_book = [];
        $book_comment_list = [];
        if ($book) {
            $recommended_book = Book::getRecommendedBookByCategory($book['CategoryTwoID'], 'Two', $book['ID']);
            $recommended_book = $recommended_book['data'];
            $book['NewAuthor'] = explode(',', $book['NewAuthor']);
            $book['ReleaseTime'] = date('Y-m-d', strtotime($book['ReleaseTime']));

            $category_one = Category::getCategoryByID($book['CategoryOneID']);
            $category_two = Category::getCategoryByID($book['CategoryTwoID']);
            $book['CategoryOne'] = empty($category_one) ? '无' : $category_one['category_name'];
            $book['CategoryTwo'] = empty($category_two) ? '无' : $category_two['category_name'];

            $member_level_class_map = config('memberlevel');
            $book_comment_list = Comment::getCommentBySku($book['Sku']);
            foreach ($book_comment_list as &$item) {
                $item['MembershipLevelCssClass'] = isset($member_level_class_map[$item['MembershipLevel']]) ? $member_level_class_map[$item['MembershipLevel']] : $member_level_class_map['普通会员'];
            }
        }
        return view('book_detail', [
            'book_id' => $id,
            'book_info' => $book,
            'recommended_book' => $recommended_book,
            'book_comment_list' => $book_comment_list,
        ]);
    }

    public function author_detail($name) {
        $author = Author::getAuthorByName($name);
        $author_book_list = [];
        if ($author) {
            $author_book_list = Author::getRecommendedBookByAuthor($name);
            $author_book_name = [];
            foreach ($author_book_list as $book_item) {
                $author_book_name[] = '《' . $book_item['Title'] . '》';
            }
            if ($author_book_name) {
                $author['AuthorDesc'] .= '相关作品有' . implode('、', $author_book_name);
            }
        }
        return view('author_detail', [
            'author_info' => $author,
            'author_book_list' => $author_book_list
        ]);
    }

    public function press_detail($name) {
        $press = Press::getPressByName($name);
        $press_book_list = [];
        if ($press && $press['BookIDStr']) {
            $press_book_list = Press::getRecommendedBookByPress($press['BookIDStr']);
        }
        return view('press_detail', [
            'press_info' => $press,
            'press_book_list' => $press_book_list
        ]);
    }

    public function category() {
        return view('category', [
            'category' => Category::getCategoryTree()
        ]);
    }

    public function category_detail($id) {
        $category_info = Category::getCategoryByID($id);
        $book_page = [];
        if ($category_info) {
            $category_type = empty($category_info['child']) ? 'Two' : 'One';
            $book_page = Book::getRecommendedBookByCategory($id, $category_type);
            $category_info['category_nav_bar'] = Category::getCategoryNavBar($id);
        }

        // 分页信息处理
        if ($book_page) {
            $category_info['category_book_list']['data'] = $book_page['data'];
            $category_info['category_book_list']['page'] = [
                'current_page' => $book_page['current_page'],
                'page_range' => Book::generatePageRange($book_page['current_page'], $book_page['last_page'], 4),
                'page_url' => $book_page['path'],
                'prev_page_url' => isset($book_page['prev_page_url']) ? $book_page['prev_page_url'] : '',
                'next_page_url' => isset($book_page['next_page_url']) ? $book_page['next_page_url'] : '',
            ];
        }
        return view('category_detail', [
            'category_info' => $category_info
        ]);
    }

    public function about() {
        return view('about');
    }
}

