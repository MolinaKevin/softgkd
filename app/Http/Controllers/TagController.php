<?php

namespace App\Http\Controllers;

use App\DataTables\TagDataTable;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Repositories\TagRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TagController extends AppBaseController
{
    /** @var  TagRepository */
    private $tagRepository;

    public function __construct(TagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the Tag.
     *
     * @param TagDataTable $tagDataTable
     * @return Response
     */
    public function index(TagDataTable $tagDataTable)
    {
        return $tagDataTable->render('tags.index');
    }

    /**
     * Show the form for creating a new Tag.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created Tag in storage.
     *
     * @param CreateTagRequest $request
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $input = $request->all();

        $tag = $this->tagRepository->create($input);

        Flash::success('Tag saved successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified Tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified Tag in storage.
     *
     * @param  int              $id
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $tag = $this->tagRepository->update($request->all(), $id);

        Flash::success('Tag updated successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified Tag from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error('Tag not found');

            return redirect(route('tags.index'));
        }

        $this->tagRepository->delete($id);

        Flash::success('Tag deleted successfully.');

        return redirect(route('tags.index'));
    }

    /**
     * Busqeuda ajax
     *
     * @param  Request $request
     *
     * @return string
     */

    public function busqueda(Requests $request)
    {
        if ($request->ajax()) {
            $output = "";
            $tags = $this->tagRepository->orderBy('codigo', 'asc')->findLike($request->q);
            if ($tags) {
                foreach ($tags as $key => $tag) {
                    $output .= "<tr data-id=\"$tag->id\">"
                        . "<td>$tag->codigo</td>"
                        . '<div class="btn-group">'
                        . '<a href="' . route('tags.show', [$tag->id]). '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'
                        . '<a href="' . route('tags.edit', [$tag->id]) . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'
                        . '<a href="#" class="btn btn-danger btn-xs" onclick="return alert(\'La funcion de borrar está desactivada en el buscado rapido\')" disabled="disabled"><i class="glyphicon glyphicon-trash"></i></a>'
                        . '</div>'
                        . '</td>'
                        . '</tr>';
                }
                return $output;
            }
        }
    }
}
