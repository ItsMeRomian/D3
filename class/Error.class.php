<?php
class ErrorHandler
{

    public int $errorCode;
    public string $errorMessage;

    function __construct($errorCode, $errorMessage)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
    }

    /**
     * killing()
     * Display an error and kill the current execution of a page
     * 
     * @return void
     */
    function killing(): void
    {
        die("
        <span class='error'>
            <span class='title'>Something went wrong!</span><br>
            $this->errorCode: $this->errorMessage
        </span>");
    }


    /**
     * soft
     * Display an error without killing the page. 
     * 
     * @return void
     */
    function soft(): void
    {
        echo "
        <span class='error'>
            <span class='title'>Something went wrong!</span><br>
            $this->errorCode: $this->errorMessage
        </span>";
    }
}
