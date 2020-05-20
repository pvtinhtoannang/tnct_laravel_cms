<?php
/**
 * @return string
 * @var $current_lesson
 * @var $section
 * @var $lesson
 */
?>
@if($builder !== null)
    <section class="mn-khkt-learning">
        <div class="learning-container">
            <div class="left-content">
                @if(isset($current_lesson))
                    @if($current_lesson->video !== null)
                        <div class="learning-video-wrapper">
                            @if($video_type === 'youtube')
                                <?php
                                $url = $current_lesson->video->meta_value;
                                parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
                                ?>
                                <div class="video-wrapper">
                                    <iframe src="//www.youtube.com/embed/{{$my_array_of_vars['v']}}"
                                            frameborder="0" allowfullscreen class="video"></iframe>
                                </div>
                            @elseif($video_type === 'vimeo')
                                <?php
                                $url = $current_lesson->video->meta_value;
                                $vimeo_id = (int)substr(parse_url($url, PHP_URL_PATH), 1);
                                ?>
                                <div class="video-wrapper">
                                    <iframe src="https://player.vimeo.com/video/{{$vimeo_id}}"
                                            webkitallowfullscreen mozallowfullscreen allowfullscreen
                                            class="video"></iframe>
                                </div>
                            @elseif($video_type === 'drive')
                                @dump('drive')
                            @endif
                        </div>
                    @endif
                @endif
                <div class="container-fluid">

                </div>
            </div>
            <div class="right-content">
                <div class="course-content-wrapper">
                    <div id="course-content-accordion">
                        @foreach($builder as $i => $section)
                            <div class="section-heading" id="section-heading-{{$i}}">
                                <h5 class="mb-0 section-heading-text">
                                    <span data-toggle="collapse"
                                          data-target="#collapse-{{$i}}" aria-expanded="true"
                                          aria-controls="collapse-{{$i}}">
                                        {{$section['post_data']->post_title}}
                                    </span>
                                </h5>
                            </div>
                            <div id="collapse-{{$i}}" class="collapse @if($i === 0) show @endif"
                                 aria-labelledby="heading-{{$i}}"
                                 data-parent="#course-content-accordion">
                                <ul class="section-list">
                                    @if(!is_null($section['lessons']) && !empty($section['lessons']))
                                        @foreach($section['lessons'] as $lesson)
                                            @if($lesson['post_data']->post_status === 'publish')
                                                <?php
                                                if (Request::route()->lesson !== null && (Request::route()->lesson) * 1 === ($lesson['post_data']->ID) * 1) {
                                                    $current_class = "current-item";
                                                } else {
                                                    $current_class = '';
                                                }
                                                ?>
                                                <li class="lesson-item {{$current_class}}">
                                                    <div class="item-link">
                                                        <label class="checkbox-label">
                                                            <input type="checkbox" class="lesson-completed" aria-label="Lesson completed" data-id="{{$lesson['post_data']->ID}}">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <div class="item-container">
                                                            <a href="/khoa-hoc/{{$course->post_name}}/{{$lesson['post_data']->ID}}">{{$lesson['post_data']->post_title}}</a>
                                                            <span>{{$lesson['post_data']->post_title}}</span>
                                                            <div class="metadata">
                                                                <span><i class="fa fa-play-circle"
                                                                         aria-hidden="true"></i></span>
                                                                <span>13 phút</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
