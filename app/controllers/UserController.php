<?php

class UserController extends BaseController {
	public function form()
	{
		return View::make('form');
	}

	public function submit() {
		$file = Input::file('file');
		if($file)
			$extension = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
		else
			$extension = null;

		$validator = Validator::make(
			array(
				'file' => $file,
				'extension' => $extension
			),
			array(
				'file'          => 'required',
				'extension'      => 'in:csv,xls,xlsx'
			),
			array(
				'in' => 'The file type is invalid.',
			)
		);

		if ($validator->fails())
			 return Redirect::to('form')->withErrors($validator);
		else
			$file->move('uploads/', $file->getClientOriginalName());

		return View::make('submit');
	}

}
