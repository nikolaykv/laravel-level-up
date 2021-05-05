require('./bootstrap');

$(document).ready(function () {
    /**
     * Parameters
     * select        - jQuery selector
     * button        - jQuery selector
     * style         - javascript object
     * invalidStyles - javascript object
     */
    dropDownSelectToGroupRegisterPage(
        $('.select-group'),
        $('.select-group-header'),
        {'border-color': '#a1cbef', 'box-shadow': '0 0 0 0.2rem rgb(52 144 220 / 25%)'},
        {'border-color': '#e3342f', 'box-shadow': '0 0 0 0.2rem rgb(227 52 47 / 25%)'}
    );
});

function dropDownSelectToGroupRegisterPage(select, button, styles, invalidStyles) {
    // Клик по контейнеру-кнопке
    select.on('click', '.select-group-header', function () {
        // Если dropdown уже открыт
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $(this).parent().removeAttr('style');
            // скрыть список
            $(this).next().fadeOut();
        } else {
            // иначе, показать
            $(this).addClass('open');
            // Так как select у меня кастомный, мне проще добавлять стили на focus тут, т.е. программно
            $(this).parent().css(styles);
            if ($(this).parent().hasClass('is-invalid')) {
                $(this).parent().css(invalidStyles);
            }
            $(this).next().fadeIn();
        }
    });

    // Клик по элементу списка
    select.on('click', '.select-group-item', function () {
        // Удалим класс у контейнера-кнопки
        button.removeClass('open');
        // Удалить инлайновые стили
        button.parent().removeAttr('style');
        // Когда выбран какой-либо элемент - скроем dropdown
        button.next().fadeOut();
        // Выведем выбранное значение
        button.children('span').text($(this).text());
        // В скрытый input name="group" - передадим data атрибут
        $("input[type='hidden'][name='group_id']").val($(this).attr('data-value-id'));
    });

    // Кликнули за пределами кастомного селекта
    $(document).click(function (event) {
        // Если событие действительно происходит за пределами кастомного селекта
        if (!$(event.target).closest(select).length) {
            // Скроем всё
            button.removeClass('open');
            button.parent().removeAttr('style')
            button.next().fadeOut();
        }
    });
}
