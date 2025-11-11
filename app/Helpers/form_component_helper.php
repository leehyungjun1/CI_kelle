<?php
if (!function_exists('email_input')) {
    function email_input(string $idName, string $domainName, ?string $idValue = '')
    {

        $domainValue = '';

        if ($idValue && str_contains($idValue, '@')) {
            [$idValue, $domainValue] = explode('@', $idValue, 2);
        }

        $options = ['hanmail.net','daum.net','nate.com','hotmail.com','gamil.com','icloud.com'];

        $optionHtml = '<option value="">직접입력</option>';
        foreach ($options as $option) {
            $selected = ($domainValue === $option) ? ' selected="selected"' : '';
            $optionHtml .= '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
        }

        return '
        <div class="email-group">
            <input type="text" name="'.$idName.'" value="'.esc($idValue).'" placeholder="이메일 아이디" class="form-control width-sm" />
            @
            <input type="text" name="'.$domainName.'" value="'.esc($domainValue).'" placeholder="도메인" class="form-control email_domain width-sm" />
            <div class="display-inline-block">
                <select class="email_select">'.$optionHtml.'</select>
            </div>
        </div>';
    }
}

if (! function_exists('selected')) {
    /**
     * select option 선택 헬퍼
     */
    function selected(string $current, string $value): string
    {
        return $current === $value ? 'selected' : '';
    }
}


if(! function_exists('address_input')) {
    /**
     * 주소 입력 컴포넌트 ( 다음 우변번호 서비스 포함 )
     * @param string $zoneecodeName 우편번호 input name
     * @param string $addressName 주소 input
     * @param string $addressSubName 상세주소 input
     * @param string $zonecodeValue 우편번호 value
     * @param string $addressValue 주소 value
     * @param string $addressSubValue 상세주소 value
     */

    function address_input(
        string $post_code = 'post_code',
        string $address1 = 'address1',
        string $address2 = 'address2',
        string $post_code_value = '',
        string $addressValue = '',
        string $addressSubValue = ''
    ): string {
        $post_code_value = $post_code_value ?? '';
        $addressValue = $addressValue ?? '';
        $addressSubValue = $addressSubValue ?? '';

        return <<<HTML
        <div class="form-inline mgb5">
    <span title="우편번호 입력">
        <input type="text" size="6" maxlength="5" name="{$post_code}" id="{$post_code}" class="form-control js-number" value="{$post_code_value}">
    </span>
    <input type="button" onclick="postcode_search('{$post_code}', '{$address1}', '{$address2}');" value="우편번호찾기" class="btn btn-gray btn-sm">
</div>
<div class="form-inline">
    <span title="주소 입력">
        <input type="text" name="{$address1}" id="{$address1}" class="form-control width-2xl" value="{$addressValue}">
    </span>
    <span title="상세주소 입력">
        <input type="text" name="{$address2}" id="{$address2}" class="form-control width-2xl" value="{$addressSubValue}">
    </span>
</div>
HTML;

    }

    if(!function_exists('make_email')) {
        function make_email(?string $id, ?string $domain): ?string {
            if(!$id || !$domain) {
                return null;
            }
            $email = trim($id).'@'.trim($domain);
            return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : null;
        }
    }

    if(!function_exists('dateRangePicker')) {
        function dateRangePicker(array $params = []) {
            $start = $params['start'] ?? '';
            $end = $params['end'] ?? '';
            $name = $params['name'] ?? '';
            $periods = $params['periods'] ?? '';

            ob_start();
            ?>
            <div class="date-range-picker">
                <div class="input-group js-datepicker">
                    <input type="text" class="form-control" placeholder="시작일" name="<?= esc($name) ?>" value="<?= esc($start) ?>">
                    <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                </div>
                ~
                <div class="input-group js-datepicker">
                    <input type="text" class="form-control" placeholder="종료일" name="<?= esc($name) ?>" value="<?= esc($end) ?>">
                    <span class="input-group-addon">
                        <span class="btn-icon-calendar">
                        </span>
                    </span>
                </div>

                <?php if (!empty($periods)) : ?>
                    <div class="btn-group js-dateperiod" data-toggle="buttons" data-target-name="<?= esc($name) ?>">
                        <?php foreach ($periods as $period) : ?>
                            <label class="btn btn-white btn-sm hand <?= ($period['active'] ?? false) ? 'active' : '' ?>">
                                <input type="radio" name="searchPeriod" value="<?= esc($period['value']) ?>"> <?= esc($period['label']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php
            return ob_get_clean();
        }
    }
}
