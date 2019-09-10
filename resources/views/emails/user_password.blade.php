@component('mail::message')

# Reset Password Notification


## This Message Sent to You Because You want to reset your password so please 
## click this button to reset your password
@component('mail::button',['url' =>$link])
    Reset Here
@endcomponent
@endcomponent