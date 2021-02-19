<?php

namespace App\Mail;

// use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductRequest extends Mailable
{
    use SerializesModels;
    protected $product_name;
    protected $product_image;
    protected $description;
    protected $fullname;
    protected $phone;
    protected $email;
    protected $shipping;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product_name = '', $product_image = '', $description = '', $fullname = '', $phone = '', $email = '', $shipping ='')
    {
        $this->product_name = $product_name;
        $this->product_image = $product_image;
        $this->description = $description;
        $this->fullname = $fullname;
        $this->phone = $phone;
        $this->email = $email;
        $this->shipping = $shipping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('seettu.mail.product_request')->with([
            'product_name' => $this->product_name,
            'product_image' => $this->product_image,
            'description' => $this->description,
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'email' => $this->email,
            'shipping' => $this->shipping
        ]);
    }
}
