<span>Предмет: </span><b>{{$typeFeedback}}</b>
<br>
<span>Описание вопроса: </span> <b>{{$descriptionFeedback}}</b>
<br>
@if($typeAnswer=='email')
    <span>Контактный адрес электронной почты:</span> <b>{{$email}}</b><br>
@else
    <span>Контактный телефон:</span> <b>{{$phone}}</b> <br>
@endif
