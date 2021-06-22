

    <input type="hidden" name="g_set" value="1">

    <div class="General_system_wrap_area d-block">
        <div class="single_system_wrap">
            <h5>To run cron jobs you should set this path in cPanel Cron Command field for email and Due Date Reminder.</h5>
            <div class="single_system_wrap_inner text-center">
                
                    <p>{{ 'cd ' . base_path() . '/ && php artisan schedule:run >> /dev/null 2>&1' }}</p>
                
            </div>
            <h6>In cPanel you should set time interval Twice Per day (0 0, 12 * * *).</h6>
        </div>

    </div>