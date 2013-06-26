<?php

class ValidationException extends Exception {

  protected $messages;

  /**
   * We are adjusting this constructor to receive an instance
   * of the validator as opposed to a string to save us some typing
   * @param Validator $validator failed validator object
   */
  public function __construct($validator)
  {
    $this->messages = $validator->messages();
    parent::__construct($this->messages, 400);
  }

  public function getMessages()
  {
    return $this->messages;
  }

}