<?php

namespace ZCJY\Pinche\Http\Controllers;

use ZCJY\Pinche\Http\Requests\CreateLinkRequest;
use ZCJY\Pinche\Http\Requests\UpdateLinkRequest;
use ZCJY\Pinche\Repositories\LinkRepository;
use ZCJY\Pinche\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LinkController extends AppBaseController
{
    /** @var  LinkRepository */
    private $linkRepository;

    public function __construct(LinkRepository $linkRepo)
    {
        $this->linkRepository = $linkRepo;
    }

    /**
     * Display a listing of the Link.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->linkRepository->pushCriteria(new RequestCriteria($request));
        $links = $this->linkRepository->all();

        return view('links.index')
            ->with('links', $links);
    }

    /**
     * Show the form for creating a new Link.
     *
     * @return Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created Link in storage.
     *
     * @param CreateLinkRequest $request
     *
     * @return Response
     */
    public function store(CreateLinkRequest $request)
    {
        $input = $request->all();

        $link = $this->linkRepository->create($input);

        Flash::success('Link saved successfully.');

        return redirect(route('links.index'));
    }

    /**
     * Display the specified Link.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $link = $this->linkRepository->findWithoutFail($id);

        if (empty($link)) {
            Flash::error('Link not found');

            return redirect(route('links.index'));
        }

        return view('links.show')->with('link', $link);
    }

    /**
     * Show the form for editing the specified Link.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $link = $this->linkRepository->findWithoutFail($id);

        if (empty($link)) {
            Flash::error('Link not found');

            return redirect(route('links.index'));
        }

        return view('links.edit')->with('link', $link);
    }

    /**
     * Update the specified Link in storage.
     *
     * @param  int              $id
     * @param UpdateLinkRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLinkRequest $request)
    {
        $link = $this->linkRepository->findWithoutFail($id);

        if (empty($link)) {
            Flash::error('Link not found');

            return redirect(route('links.index'));
        }

        $link = $this->linkRepository->update($request->all(), $id);

        Flash::success('Link updated successfully.');

        return redirect(route('links.index'));
    }

    /**
     * Remove the specified Link from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $link = $this->linkRepository->findWithoutFail($id);

        if (empty($link)) {
            Flash::error('Link not found');

            return redirect(route('links.index'));
        }

        $this->linkRepository->delete($id);

        Flash::success('Link deleted successfully.');

        return redirect(route('links.index'));
    }
}
