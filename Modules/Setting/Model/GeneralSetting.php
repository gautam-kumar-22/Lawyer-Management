<?php

namespace Modules\Setting\Model;

use Illuminate\Database\Eloquent\Model;
use Modules\Localization\Entities\Language;
use Modules\Setting\Model\Currency;
use Modules\Setting\Model\DateFormat;
use Modules\Setting\Model\TimeZone;
use Modules\Setting\Model\SmsGateway;

class GeneralSetting extends Model
{
    protected $guarded = [];

    protected $table = 'general_settings';

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function dateFormat()
    {
        return $this->belongsTo(DateFormat::class);
    }

    public function timeZone()
    {
        return $this->belongsTo(TimeZone::class);
    }

    public function smsGateway()
    {
        return $this->belongsTo(SmsGateway::class);
    }
}
