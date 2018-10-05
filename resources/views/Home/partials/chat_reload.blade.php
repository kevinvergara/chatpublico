<div class="box-body" style="height: 400px; overflow-y: scroll;">
    <!-- The time line -->
    <ul class="timeline">
        @foreach ($chat as $item)
            @if($item->tipo_comentario == 1) {{--tipo texto--}}
                <li>
                    <i class="fa fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                        <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado</h3>
                        <div class="timeline-body">
                            {{ $item->comentario }}
                        </div>
                    </div>
                </li>
            @elseif($item->tipo_comentario == 2){{--tipo imagen--}}
                <li>
                    <i class="fa fa-camera bg-purple"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                        <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado con una imagen</h3>
                        <div class="timeline-body">
                            <img src="{{ url("storage/".$item->ruta_storage)}}" alt="..." class="margin">
                        </div>
                        <div class="timeline-footer">
                            {{ $item->comentario }}
                        </div>
                    </div>
                </li>
            @elseif($item->tipo_comentario == 3){{--tipo video--}}
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>
                    <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $item->fecha }}</span>
                    <h3 class="timeline-header"><a href="#">{{ $item->nick_user }}</a> ha comentado con un video</h3>
                    <div class="timeline-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{url("storage/".$item->ruta_storage)}}"
                                frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="timeline-footer">
                        {{ $item->comentario }}
                    </div>
                    </div>
                </li>
            @endif
        @endforeach
        <li>
            <i class="fa fa-clock-o bg-gray"></i>
        </li>
    </ul>
</div>