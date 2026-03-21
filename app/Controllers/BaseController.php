<?php

namespace App\Controllers;

use App\Models\JySiteInfo;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    protected $jySiteInfo;
    protected $data = [];


    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->jySiteInfo = new JySiteInfo();
        $footerInfo = $this->jySiteInfo->getFooterInfo();

        helper('form_component');

        Services::renderer()->setVar('footerInfo', $footerInfo);
    }

    protected function render(string $view, array $pageData = [])
    {
        $data = array_merge($this->data, $pageData);
        $data['pagePath'] = $view;
        return view($view, $data);
    }

    /**
     * 범용 페이징
     *
     * 사용 예:
     *   $paging = $this->makePaging($model, $get);
     *
     *   return $this->render('admin/member/member_list', [
     *       'members'  => $paging['items'],
     *       ...$paging['meta'],   // pager, totalCount, searchCount, startNum, pageNum, currentPage
     *   ]);
     *
     * @param  Model  $model          이미 검색/정렬 조건이 적용된 모델 인스턴스
     * @param  array  $get            request()->getGet() 값
     * @param  int    $defaultPerPage 기본 페이지당 건수 (기본 10)
     * @return array  ['items' => [...], 'meta' => [...]]
     */
    protected function makePaging($model, array $get, int $defaultPerPage = 10): array
    {
        $pageNum     = max(1, (int)($get['pageNum'] ?? $defaultPerPage));
        $currentPage = max(1, (int)($get['page']    ?? 1));

        // 전체 건수 (검색 조건 적용 전)
        // → 컨트롤러에서 검색 조건 적용 전에 별도로 넘기거나
        //   모델에서 reset 없이 countAllResults 사용
        $searchCount = $model->countAllResults(false);
        $startNum    = max(0, $searchCount - (($currentPage - 1) * $pageNum));
        $items       = $model->paginate($pageNum);

        return [
            'items' => $items,
            'meta'  => [
                'pager'       => $model->pager,
                'searchCount' => $searchCount,
                'startNum'    => $startNum,
                'pageNum'     => $pageNum,
                'currentPage' => $currentPage,
            ],
        ];
    }

}
