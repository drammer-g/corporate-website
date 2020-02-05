<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\Responseable;
use App\Repositories\PortfolioRepository;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Portfolio;

class AdminPortfolioController extends Controller
{
    use Responseable;

    private $repository;

    public function __construct(PortfolioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $portfolio = $this->repository->all();
        return view('admin.modules.portfolios.index', compact('portfolio'));
    }

    /**
     * @param Portfolio $portfolio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Portfolio $portfolio)
    {
        return view('admin.modules.portfolios.create', compact('portfolio'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) //todo make PortfolioRequest
    {
        $portfolio = $this->repository->store($request->only([
            'description',
            'client',
            'active',
            'title',
        ]));
        return $this->redirectSuccess('admin.portfolios.index');
    }


    /**
     * @param Portfolio $portfolio
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Portfolio $portfolio)
    {
        return view('admin.modules.portfolios.edit', compact('portfolio'));
    }

    /**
     * @param Request $request
     * @param Portfolio $portfolio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Portfolio $portfolio) //TODO PortfolioRequest and $request->validated
    {
        $this->repository->update($portfolio, $request->only($request->only([
            'title', 'description', 'active', 'client'
        ])));
        return $this->redirectSuccess('admin.portfolios.index');
    }

    /**
     * @param Portfolio $portfolio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Portfolio $portfolio)
    {
        $this->repository->delete($portfolio);
        return $this->redirectSuccess('admin.portfolios.index');
    }
}