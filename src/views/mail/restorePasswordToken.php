<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\web\IdentityInterface $user */
/** @var yii\mail\MessageInterface $message */
/** @var hiqdev\php\confirmator\Token $token */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => (string) $token]);

$org = Yii::$app->params['organization.name'];

$message->setSubject(Yii::t('hiam', '[{org}] Password reset request', ['org' => $org]));

$message->renderTextBody(basename(__FILE__, '.php') . '-text', compact('user', 'resetLink', 'token'));

?>
<div class="password-reset">
    <p><?= Yii::t('hiam', 'Hello {name},', ['name' => Html::encode($user->name)]) ?></p>

    <p><?= Yii::t('hiam', 'Follow the link below to reset your password:') ?></p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    <?php if (!empty($token->get('notAfter'))) : ?>
        <p><?= Yii::t('hiam', 'Attention! Link would be invalidated after {date} UTC', ['date' => $token->get('notAfter')]) ?></p>
    <?php endif ?>
</div>
