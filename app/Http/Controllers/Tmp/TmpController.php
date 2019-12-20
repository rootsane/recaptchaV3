<?php

namespace App\Http\Controllers\Tmp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tmp\TmpRequest;
use App\Models\Tmp;
use Illuminate\Http\Request;

/**
 * Class TmpController
 * @package App\Http\Controllers\Tmp
 */
class TmpController extends Controller
{
    protected $Tmp;

    /**
     * TmpController constructor.
     * @param Tmp $tmp
     */
    public function __construct(Tmp $tmp)
    {
        $this->Tmp = $tmp;
    }


    /**
     * @param TmpRequest $request
     */
    public function show(TmpRequest $request)
    {

    }

    /**
     * @param TmpRequest $request
     */
    public function store(TmpRequest $request)
    {

    }


    /**
     * @param TmpRequest $request
     */
    public function update(TmpRequest $request)
    {

    }

    /**
     * @param TmpRequest $request
     */
    public function destroy(TmpRequest $request)
    {

    }
}
