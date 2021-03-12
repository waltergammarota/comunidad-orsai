@foreach($form->inputs()->get() as $input)
    {!! $input->toHtml($answers)!!}
@endforeach
