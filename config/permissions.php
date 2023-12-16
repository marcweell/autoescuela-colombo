<?php
return [
    "App\\Http\\Controllers\\Auth\\DownloadController@download" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "download"
    ],
    "App\\Http\\Controllers\\IndexController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.read"
    ],
    "App\\Http\\Controllers\\IndexController@blogIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.blog.read"
    ],
    "App\\Http\\Controllers\\IndexController@postIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.blog.post.read"
    ],
    "App\\Http\\Controllers\\IndexController@aboutIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.about.read"
    ],
    "App\\Http\\Controllers\\IndexController@faqIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.faq.read"
    ],
    "App\\Http\\Controllers\\IndexController@contactIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.contact.read"
    ],
    "App\\Http\\Controllers\\IndexController@planIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.plan.read"
    ],
    "App\\Http\\Controllers\\IndexController@privacyIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.privacy.read"
    ],
    "App\\Http\\Controllers\\IndexController@termsIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.terms.read"
    ],
    "App\\Http\\Controllers\\IndexController@handleInvite" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "public.invite.read"
    ],
    "App\\Http\\Controllers\\WebApiController@subscribe" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "public.api.subscribe"
    ],
    "App\\Http\\Controllers\\WebApiController@sendMessage" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "public.api.message.send"
    ], 
    "App\\Http\\Controllers\\UserUi\\AuthController@logout" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.auth.logout"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@postLogout" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.auth.logout.post"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@loginIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.auth.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@login" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.auth.login"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@reAuth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.auth.reAuth"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@oauthIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.oauth.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@oauth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.oauth.auth"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@signupIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.signup.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@signup" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.signup"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@activationIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.activation.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@activate" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.activation.auth"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@otpIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.activation.otp.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@otpAuth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.activation.otp.auth"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@forgotIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "account.forgot.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AuthController@forgot" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "account.forgot.auth"
    ],
    "App\\Http\\Controllers\\UserUi\\IndexController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.read"
    ],
    "App\\Http\\Controllers\\UserUi\\IndexController@postIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.postIndex"
    ],
    "App\\Http\\Controllers\\UserUi\\AccountController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.profile.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AccountController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.read"
    ],
    "App\\Http\\Controllers\\UserUi\\AccountController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.update"
    ],
    "App\\Http\\Controllers\\UserUi\\Password_changeController@changeIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.password.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Password_changeController@change" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.password.update"
    ],
    "App\\Http\\Controllers\\UserUi\\AccountController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\AccountController@change_picture" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.profile.change_picture"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.add"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.update"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@searchIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.search.read"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@search" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.search"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\MandalaController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandalanate.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.add"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.update"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@refuse" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.approvement.refuse"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@accept" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.approvement.accept"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandalanate.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_donateController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandalanate.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.add"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.manage"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@joinIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.join.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@join" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.join"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@manageIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.manage.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@treeViewIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.manage.tree.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@cicleViewIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.manage.cicle.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_participantController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.participant.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.add"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.manage"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@joinIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.join.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@join" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.join"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@manageIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.manage.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Mandala_inviteController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.mandala.invite.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.wallet.read"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.read"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.add"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@rechargeIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.wallet.recharge.read"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@recharge" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.recharge"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.read"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.update"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.wallet.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\WalletController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.wallet.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.transaction.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.transaction.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.transaction.add"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.transaction.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.transaction.update"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.transaction.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\TransactionController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.transaction.detail.read"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.notification.read"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.notification.read"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.notification.add"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.notification.read"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.notification.update"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@removeIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.notification.read"
    ],
    "App\\Http\\Controllers\\UserUi\\NotificationController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.notification.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\TestimonyController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.testimony.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TestimonyController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.testimony.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TestimonyController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.testimony.add"
    ],
    "App\\Http\\Controllers\\UserUi\\TestimonyController@removeIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.testimony.read"
    ],
    "App\\Http\\Controllers\\UserUi\\TestimonyController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.testimony.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\PlanController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.plan.read"
    ],
    "App\\Http\\Controllers\\UserUi\\PlanController@joinIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.plan.join.read"
    ],
    "App\\Http\\Controllers\\UserUi\\PlanController@join" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.plan.join"
    ],
    "App\\Http\\Controllers\\UserUi\\Share_linkController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.share_link.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Share_linkController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.share_link.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Share_linkController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.share_link.add"
    ],
    "App\\Http\\Controllers\\UserUi\\Share_linkController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.share_link.read"
    ],
    "App\\Http\\Controllers\\UserUi\\Share_linkController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.share_link.update"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.user_social_media.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_social_media.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_social_media.add"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_social_media.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_social_media.update"
    ],
    "App\\Http\\Controllers\\UserUi\\User_social_mediaController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_social_media.remove"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.add"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.read"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.update"
    ],
    "App\\Http\\Controllers\\UserUi\\User_payment_methodController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "app.user_payment_method.remove"
    ], 
    "App\\Http\\Controllers\\AdminUi\\AuthController@logout" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.auth.logout"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@postLogout" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.auth.logout.post"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@loginIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.auth.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@login" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.auth.login"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@reAuth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.auth.reAuth"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@oauthIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.oauth.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@oauth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.oauth.auth"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@activationIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.activation.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@activate" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.activation.auth"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@otpIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.activation.otp.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@otpAuth" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.activation.otp.auth"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@forgotIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.forgot.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AuthController@forgot" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.forgot.auth"
    ],
    "App\\Http\\Controllers\\AdminUi\\IndexController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\IndexController@postIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.postIndex"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.account.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Password_changeController@changeIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.profile.password.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Password_changeController@change" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.profile.password.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\AccountController@change_picture" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.account.change_picture"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.wallet.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.wallet.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.wallet.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@rechargeIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.finance.wallet.recharge.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@recharge" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.wallet.recharge"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.wallet.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.wallet.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.finance.wallet.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\WalletController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.wallet.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.finance.transaction.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MandalaController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.invite.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@refuse" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.approvement.refuse"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@accept" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.approvement.accept"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_donateController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandalanate.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.manage"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@manageIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.manage.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Mandala_participantController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.participant.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@statisticsIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.statistics.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@statistisRepostIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.mandala.statistics.report.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TransactionController@statisticsReportDownload" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.mandala.statistics.report.download"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.admin.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.admin.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.admin.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.admin.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.admin.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.admin.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\AdminController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.admin.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.user.role.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\RoleController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Role_permissionController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.user.role.role_permission.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Role_permissionController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.role_permission.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Role_permissionController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.role.role_permission.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.testimony.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.testimony.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.testimony.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.testimony.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.testimony.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\TestimonyController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.testimony.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.subscriber.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.subscriber.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.subscriber.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.subscriber.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.subscriber.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\SubscriberController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.subscriber.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\MessageController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.message.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MessageController@replyIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.message.reply.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MessageController@composeIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.message.compose.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MessageController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.message.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\MessageController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.message.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.gallery.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.gallery.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.gallery.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.gallery.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.gallery.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\GalleryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.gallery.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.services.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.services.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.services.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.services.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.services.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\ServicesController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.services.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_infoController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.page_info.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_infoController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.page_info.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_infoController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.page_info.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_infoController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.page_info.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_infoController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.page_info.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.blog_post.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_postController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Blog_post_attachmentController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.blog_post.blog_post_attachment.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.read"
    ], 
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@emailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.email.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@composeEmailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.email.compose.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@sendEmail" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.email.compose.send"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@statisticsIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.statistics.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@statistisRepostIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.statistics.report.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@statisticsReportDownload" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.statistics.report.download"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@settingsIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.settings.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@settingsUpdateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.settings.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Bulk_messageController@settingsUpdate" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.bulk_message.settings.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.user.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\UserController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.user.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\SettingsController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\FaqController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.faq.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\CurrencyController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.currency.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Payment_methodController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.payment_method.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_typeController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_type.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Document_categoryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settingscument_category.remove"
    ],  
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Contract_typeController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.contract_type.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\GenderController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.gender.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Social_mediaController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.social_media.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Marital_statusController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.marital_status.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Academic_degreeController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.academic_degree.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Notification_modelController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.notification_model.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@updateIconIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.update.icon.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@updateIcon" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.update.icon"
    ],
    "App\\Http\\Controllers\\AdminUi\\PlanController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.plan.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\CountryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.country.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\CityController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.geo.city.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Company_categoryController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.company_category.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Job_categoryController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.job_category.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Event_categoryController@detailIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.settings.event_category.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Session_historyController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.auditory.session_history.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Session_historyController@addIndex" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.auditory.page_visit.detail.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Session_historyController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.auditory.session_history.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Operation_historyController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.auditory.operation_history.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Operation_historyController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.auditory.operation_history.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_visitController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.page_visit.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Page_visitController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.auditory.page_visit.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\DeveloperController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.developer.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\Admin_menuController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.admin_menu.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.developer.module.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.module.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.module.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.module.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.module.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\ModuleController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.module.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\PermissionController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.permission.remove"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.developer.language.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.language.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.language.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.language.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.language.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\LanguageController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.developer.language.remove"
    ], 
    "App\\Http\\Controllers\\AdminUi\\StatisticController@generate" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.statistic.print"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@index" => [
        "is_html" => true,
        "is_prefix" => false,
        "permission" => "admin.file.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@addIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.file.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@add" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.file.add"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@updateIndex" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.file.read"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@update" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.file.update"
    ],
    "App\\Http\\Controllers\\AdminUi\\FileController@remove" => [
        "is_html" => false,
        "is_prefix" => false,
        "permission" => "admin.file.remove"
    ]
];