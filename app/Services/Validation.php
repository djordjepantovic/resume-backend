<?php

namespace Resume\Services;

class Validation
{
	private $errors = [];

	public function make(array $data, $rules = [])
	{
		$this->clearErrors();

		foreach ($rules as $fieldname => $rule) {
			$callbacks = explode('|', $rule);

			foreach ($callbacks as $callback) {
				$value = isset($data[$fieldname]) ? $data[$fieldname] : null;
				$this->$callback($value, $fieldname);
			}
		}
	}

	public function required($value, $fieldname)
	{
		if (empty($value)) {
			$this->errors[$fieldname] = $fieldname .' is required';
		}

		return true;
	}

	public function email($value, $fieldname)
	{
		if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->errors[$fieldname] = $fieldname .'  needs to be a valid';
		}

		return true;
	}

	public function errors()
	{
		return $this->errors;
	}

	protected function clearErrors()
    {
        $this->errors = [];
    }

	/**
     * Checks if validation has passed.
     *
     * @return bool
     */
	public function passes()
	{
		return empty($this->errors);
	}

	/**
     * Checks if validation has failed.
     *
     * @return bool
     */
    public function fails()
    {
        return ! $this->passes();
    }
}