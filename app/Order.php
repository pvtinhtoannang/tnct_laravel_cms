<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_content',
        'order_status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    function updateStatus($id, $status)
    {
        $order = $this->find($id);
        if ($order === null) {
            return false;
        } else {
            $order->update(array(
                    'order_status' => $status
                )
            );
            return true;
        }
    }
}
