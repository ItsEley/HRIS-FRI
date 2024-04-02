<style>
    #performance_eval_table {
      border-collapse: collapse;
      margin: auto;
    }

    #performance_eval_table th, #performance_eval_table td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    .fa-star {
      color: #ccc;
      transition: color 0.3s;
      cursor: pointer;
      font-size: 22px; /* Change the size of the stars */
     
    }

    .fa-star.checked,
    .fa-star:hover {
      color: gold;
    }
    .star {
      display: flex;
      justify-content: center;
    }
    .card-header{
      width: auto;
      justify-content: center;
    }
    .eval-points{
        text-align: start;
    }

  </style>

<!-- Modal -->
<div class="modal fade" id="modal_evaluate_emp" tabindex="-1" aria-labelledby="modal_evaluate_empLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_evaluate_empLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container text-center">
                    <div class="card">
                        <div class="card-header text-center">
                            The table below contains the description of the rating of each performance with corresponding points.
                            Select the appropriate score in the evaluation form intended for the employee who desires to be evaluated.
                        </div>
                        <div class="card-body">
                            <table id = "performance_eval_table">
                                <tr>
                                    <th>PERFORMANCE FACTOR</th>
                                    <th>RATING SCALE</th>
                                </tr>
                                <tr>
                                    <td>
                                        <b>1. JOB KNOWLEDGE</b>
                                        <br>
                                        <p> - the extent of employee's <u>wisdom and understanding</u> to the details
                                            and nature of his/her assigned job and related duties. Equipped with technical and practical skill-set
                                            necessary to the position.
                                        </p>
                                        <div class="star" id="rating1">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>

                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Manifested a highly developed and relevant skills and abilities and would perform
                                                consistently well against the criterion.</li>
                                            <li><b>4 points</b> - Acquired relevant skills, abilities and persnonal qualities, and
                                                would be generally effective according to job details.</li>
                                            <li><b>3 points</b> - Posseses some skills, abilities and personal qualities relevant to the criterion,
                                                but is limited in others and related tasks.</li>
                                            <li><b>2 points</b> - Able to temporarily perform the duties of the position with the close supervision,
                                                but would acquire further training and development to fully carry out duties with the criterion.</li>
                                            <li><b>1 point</b> - Unable to demonstrate the adequate skills, abilities and personal qualities in relation to the criterion.
                                                Not suitable to perform the duties of the position relevant to this criterion, even on a temporary basis.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>2. QUALITY OF WORK</b> <br>
                                        <p> - the value of work produced by the employee and the <u>thoroughness, accuracy, neatness, and acceptability of the work completed.</u>
                                            Ability to work under pressure and learn from previous mistakes.
                                        </p>
                                        <div class="star" id="rating2">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>

                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Quality of work is outstanding and beyond expectation. No repetition of failed tasks.</li>
                                            <li><b>4 points</b> - Trait of work is frequently above standards expected for position.</li>
                                            <li><b>3 points</b> - Work characteristics are as expected standard for position. May repeat failed tasks.</li>
                                            <li><b>2 points</b> - Work is inconsistent and poor in quality, Unsuccessful assignments was repeated then failed again.</li>
                                            <li><b>1 point</b> - Unacceptable quality and cannot complete requirements. </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>3. QUANTITY OF WORK</b> <br>
                                        <p> - <u>use</u> of time, <u>volume</u> of work accomplished, ability to meet <u>schedules and efficiency</u> levels.


                                        </p>
                                        <div class="star" id="rating3">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Frequently accomplishes an exceptional amount of work on a consistent basis.</li>
                                            <li><b>4 points</b> - Very efficient; accomplishes an above average amount of work.</li>
                                            <li><b>3 points</b> - Good work producttion and effiency; accomplishes an expected amount of work on a consistent basis.</li>
                                            <li><b>2 points</b> - Expectations of the amount of work performed rarely attained. Amount of work accomplishes is unacceptable.</li>
                                            <li><b>1 point</b> - Incomplete completin of assignments. Amount of work accomplishes is unacceptable.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>4. DEPENDABILITY AND RESPONSIBILITY</b> <br>
                                        <p>
                                            - the thoroughness demonstrated by the employee in following through on assignments and instructions in a <u>reliable, trustworthy
                                                and timely manner.</u>
                                        </p>
                                        <div class="star" id="rating4">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Steers up the tsak with exceptional degree of independence and effiency.</li>
                                            <li><b>4 points</b> - Handle assignments with expected degree of independence and effiency.</li>
                                            <li><b>3 points</b> - Carries out instructions and responsibilities with close supervision.</li>
                                            <li><b>2 points</b> - Must be very closely supervised to complete work assignments. Waits for command.</li>
                                            <li><b>1 point</b> - Unable to complete work assignments without supervision. Work when asked.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>5. INNOVATION AND CREATIVITY</b> <br>
                                        <p> - Provides new and innovative ideas to improve processes. Spends a great deal of time researching solutions, and new technologies to solve problems.
                                            Work towards improving effiencies, and quality. Often thinks outside the box when <u>solving problems or making improvements.</u>
                                        </p>
                                        <div class="star" id="rating5">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Always exhibit original thought; always suggest needed action and pursues problem without
                                                supervison. Assertive and initiates progress.</li>
                                            <li><b>4 points</b> - Almost always contributes to or develops new processes and method;
                                                always shows flexibility in adjusting to changes and supervisor/manager expectations. </li>
                                            <li><b>3 points</b> - Cooperates in implementing new processes and method; shows tractability
                                                in adjusting to changes and supervisor/manager expectations. </li>
                                            <li><b>2 points</b> - shows little flexibility for adjustments; Rarely contributes for any thought.</li>
                                            <li><b>1 point</b> - May note once in contributing for any ideas; unwilling for change.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>6. INIATIVE AND RESOURCEFULNESS</b> <br>
                                        <p> - willingness to make significant contributions with little direction, <u>voluntarily</u> start projects, attempt non-routine jobs and tasks.
                                            Works with <u> energy, enthusiasm and ingenuity.</u>

                                        </p>
                                        <div class="star" id="rating6">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Independently accomplishes an idea ahead of time using resources aside from the available
                                                surrounds him/her and manifests significant leadership. Plans a week or more ahead of time.</li>
                                            <li><b>4 points</b> - Starting a new idea after the discussion of idea; a work is done before the superior checks it. Plans with days of allowance.</li>
                                            <li><b>3 points</b> - Proposes idea during and not during discussions; accomplishes a tasks as needed.</li>
                                            <li><b>2 points</b> - Occasionally exhibits original thought; requires frequent supervision.</li>
                                            <li><b>1 point</b> - Must prompted continually to perform job duties and follow through; never suggest
                                                needed action; requires constant supervision.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>7. ATTENDANCE AND PUNCTUALITY</b> <br>
                                        <p> - overall attendance, adherence to work schedules, office hours, time limits for lunches, gives prompt notice of absence.</p>
                                        <div class="star" id="rating7">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Consistently present and on time. Never in a hurry to start the work.</li>
                                            <li><b>4 points</b> - Demonstrates adequate attendance and punctuality. Has a little allowance of early time</li>
                                            <li><b>3 points</b> - Has a difficulty in attendance and punctuality. With enough preparation time for work.</li>
                                            <li><b>2 points</b> - Usually absent and late. Almost in a hurry to start the work.</li>
                                            <li><b>1 point</b> - Habitual absent and late. Neglects the reminders for smart time management</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>8. INTERPERSONAL RELATIONS</b> <br>
                                        <p> - how well does the employee get along with other individuals in the performance og job duties. Consider effectiveness
                                            of relations with co-employees, subordinates, supervisor and manager in handling of position responsibilities.
                                            The <u>cooperativeness,tact and courtesy</u>.</p>
                                        <div class="star" id="rating8">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Has a very effective interpersonally; work extremely well with others; able to
                                                express his/her thoughts in a courteous manner.</li>
                                            <li><b>4 points</b> - Works well with others; facilitates cooperation. Does not involve in quarrel.</li>
                                            <li><b>3 points</b> - Relates to others fairly well; influences co-employees in maintaining the culture.</li>
                                            <li><b>2 points</b> - Has difficulty in relation to others; not readily cooperative. Response as needed.</li>
                                            <li><b>1 point</b> - No relation to others; not cooperative.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>9. TEAMWORK</b> <br>
                                        <p> - works cooperatively with others; contributes to team objectives; considers the impact on co-workers;
                                            views work from a team perspective.
                                        </p>

                                        </p>

                                        <div class="star" id="rating9">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Contributes significantly into the team's performance; Influences co-employees to exert efforts
                                                according to their roles; shows good inter-team relationships.</li>
                                            <li><b>4 points</b> - Almost always willing to help others when need; always cooperative always considers the impact
                                                of actions on co-workers</li>
                                            <li><b>3 points</b> - Consistently offers to help others when needed; cooperative most of the time.</li>
                                            <li><b>2 points</b> - Occasionally offers to help others; often difficulty working with others.</li>
                                            <li><b>1 point</b> - Rarely offers to help; usually has difficulty working with others as a part of a
                                                team; indifferent to the impact of actions on a co-workers.</li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>10. QUANTITATIVE ACHIEVEMENT</b> <br>
                                        <p> - manifest impact through outputs from achieving the minimum or above the set standard. Data from
                                            reports shows the ranger of target success. <br>
                                            <br>
                                            <i>(may refer from the reports)</i>
                                        </p>
                                        <div class="star" id="rating10">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <ul style="list-style-type: none; padding: 0;" class = "eval_points">
                                            <li><b>5 points</b> - Established a consistent successfull achievement of target in monthly basis.</li>
                                            <li><b>4 points</b> - Achieves the target but not consecutive timeable.</li>
                                            <li><b>3 points</b> - Successfully execute the goals that does not provide significant impact.</li>
                                            <li><b>2 points</b> - Carry out a traget in a conventional manner that anyone may achieve.</li>
                                            <li><b>1 point</b> - For consecutive months, the employee is the below the minimum standard. </li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Finish</button>
            </div>
        </div>
    </div>
</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<script>
    // JavaScript for star ratings
    const ratings = document.querySelectorAll('[id^="rating"]');

    ratings.forEach((rating, index) => {
        const stars = rating.querySelectorAll('.fa-star');

        stars.forEach((star, starIndex) => {
            star.addEventListener('click', () => {
                resetStars(stars);
                highlightStars(stars, starIndex);
            });
        });
    });

    function resetStars(stars) {
        stars.forEach(star => {
            star.classList.remove('checked');
        });
    }

    function highlightStars(stars, starIndex) {
        for (let i = 0; i <= starIndex; i++) {
            stars[i].classList.add('checked');
        }
    }
</script>