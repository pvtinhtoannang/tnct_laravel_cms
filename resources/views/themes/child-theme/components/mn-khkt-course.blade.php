<?php
$course_builder = $post->meta()->where('meta_key', 'course_builder_user')->first();
$builderArray = json_decode($course_builder->meta_value, true);
?>
<section class="mn-khkt-course">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">

            </div>
            <div class="col-md-3">
                <div class="course-content-wrapper">
                    @if($course_builder)
                        <?php
                        $builderArray = json_decode($course_builder->meta_value, true);
                        ?>
                        <div id="course-content-accordion">
                            @if(!is_null($builderArray))
                                @foreach($builderArray as $i => $builder)
                                    <?php
                                    /** @var $builder */
                                    $post_data = $post->find($builder['ID']);
                                    $lessons = $builder['lessons'];
                                    ?>
                                    @if($post_data->post_type === 'section_heading')
                                        <div class="section-heading" id="section-heading-{{$i}}">
                                            <h5 class="mb-0 section-heading-text">
                                                <span data-toggle="collapse"
                                                      data-target="#collapse-{{$i}}" aria-expanded="true"
                                                      aria-controls="collapse-{{$i}}">
                                                    {{$post_data->post_title}}
                                                </span>
                                            </h5>
                                        </div>

                                        <div id="collapse-{{$i}}" class="collapse @if($i === 0) show @endif"
                                             aria-labelledby="heading-{{$i}}"
                                             data-parent="#course-content-accordion">
                                            <div class="lessons-wrapper">
                                                @if(!is_null($lessons) && !empty($lessons))
                                                    @foreach($lessons as $lesson)
                                                        <?php
                                                        /** @var $lesson */
                                                        $post_data = $post->find($lesson['ID']);
                                                        ?>
                                                        @if($post_data->post_status === 'publish')
                                                            <div class="lesson-item">
                                                                {{$post_data->post_title}}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
