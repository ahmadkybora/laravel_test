<h1>Source Code</h1>
<h3>Back-End Source-Code with Laravel</h3>
------------------------------------------
<h3>Schema</h3>
------------------------------------------
------------------------------------------


<h3>students table</h3>
------------------------------------------
<h3>columns :</h3>
<p>id: pramary_key, int</p>
<p>first_name: string</p>
<p>last_name: string</p>
<p>student_code: unique, string</p>
<p>national_code: unique, pramary_key</p>
------------------------------------------
<h3>lessons table</h3>
------------------------------------------
<h3>columns :</h3>
<p>id: pramary_key, int</p>
<p>lesson_name: unique, string</p>
<p>lesson_code: unique, string</p>
<p>units: integer</p>
------------------------------------------

<h3>برای اجرای پروژه لطفا تنظیمات زیر را انجام دهید</h3>
<p>یک دیتابیس بسازید</p>
<p>دستور زیر را اجرا کنید</p>
<p>php artisan migrate</p>