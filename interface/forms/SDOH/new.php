<?php

/**
* SDOH form (modified from Review of Systems Checks)
*
* @package   OpenEMR
* @link      http://www.open-emr.org
* @author    sunsetsystems <sunsetsystems>
* @author    cfapress <cfapress>
* @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Char Miller <charjmiller@gmail.com>
* @copyright Copyright (c) 2009 sunsetsystems <sunsetsystems>
* @copyright Copyright (c) 2008 cfapress <cfapress>
* @copyright Copyright (c) 2016-2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2022 Char Miller <charjmiller@gmail.com>
* @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
*/

require_once(__DIR__ . "/../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

$returnurl = 'encounter_top.php';
?>
<html>
<head>
    <title><?php echo xlt("Social Screening Tool"); ?></title>

    <?php Header::setupHeader();?>

    <script type="text/javascript" language="JavaScript">

        $(function () {
            document.body.addEventListener('click', CalculateTotal, true);
        })

            function CalculateTotal() {
                let totalscore = 0;
                if (document.getElementById('lessthanhs').checked == true) {totalscore +=5; }
                if (document.getElementById('highschool').checked == true) {totalscore +=3; }
                if (document.getElementById('associate').checked == true) {totalscore +=1; }
                if (document.getElementById('disabilityyes').checked == true) {totalscore +=5; }
                if (document.getElementById('housetemporary').checked == true) {totalscore +=2; }
                if (document.getElementById('houseunsafe').checked == true) {totalscore +=2; }
                if (document.getElementById('housecar').checked == true) {totalscore +=3; }
                if (document.getElementById('houseunshelter').checked == true) {totalscore +=5; }
                if (document.getElementById('houseother').checked == true) {totalscore +=1; }
                if (document.getElementById('worktemporary').checked == true) {totalscore +=1; }
                if (document.getElementById('workseasonal').checked == true) {totalscore +=1; }
                if (document.getElementById('worklooking').checked == true) {totalscore +=3; }
                if (document.getElementById('workretired').checked == true) {totalscore +=1; }
                if (document.getElementById('workdisabled').checked == true) {totalscore +=3; }
                if (document.getElementById('careunder5').checked == true) {totalscore +=5; }
                if (document.getElementById('care5to12').checked == true) {totalscore +=3; }
                if (document.getElementById('careover12').checked == true) {totalscore +=1; }
                if (document.getElementById('carespecneeds').checked == true) {totalscore +=5; }
                if (document.getElementById('caredisabled').checked == true) {totalscore +=5; }
                if (document.getElementById('careelderly').checked == true) {totalscore +=5; }
                if (document.getElementById('careother').checked == true) {totalscore +=1; }
                if (document.getElementById('debtmedical').checked == true) {totalscore +=3; }
                if (document.getElementById('debtcreditcards').checked == true) {totalscore +=1; }
                if (document.getElementById('debtrent').checked == true) {totalscore +=1; }
                if (document.getElementById('debtstudentloans').checked == true) {totalscore +=1; }
                if (document.getElementById('debttaxes').checked == true) {totalscore +=1; }
                if (document.getElementById('debtlegal').checked == true) {totalscore +=1; }
                if (document.getElementById('debtcar').checked == true) {totalscore +=1; }
                if (document.getElementById('debtutilities').checked == true) {totalscore +=1; }
                if (document.getElementById('debtother').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyfood').checked == true) {totalscore +=3; }
                if (document.getElementById('moneymedical').checked == true) {totalscore +=2; }
                if (document.getElementById('moneychildcare').checked == true) {totalscore +=2; }
                if (document.getElementById('moneyutilities').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyphone').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyrent').checked == true) {totalscore +=2; }
                if (document.getElementById('moneytransportation').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyclothing').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyeducation').checked == true) {totalscore +=1; }
                if (document.getElementById('moneyother').checked == true) {totalscore +=1; }
                if (document.getElementById('transportmedical').checked == true) {totalscore +=1; }
                if (document.getElementById('transportfood').checked == true) {totalscore +=2; }
                if (document.getElementById('transportwork').checked == true) {totalscore +=2; }
                if (document.getElementById('transportschool').checked == true) {totalscore +=1; }
                if (document.getElementById('transportfamily').checked == true) {totalscore +=1; }
                if (document.getElementById('transportother').checked == true) {totalscore +=1; }
                if (document.getElementById('medicalnoinsurance').checked == true) {totalscore +=3; }
                if (document.getElementById('medicalcopay').checked == true) {totalscore +=2; }
                if (document.getElementById('medicalnotcovered').checked == true) {totalscore +=2; }
                if (document.getElementById('medicalwork').checked == true) {totalscore +=1; }
                if (document.getElementById('medicalnoprovider').checked == true) {totalscore +=1; }
                if (document.getElementById('medicalunderstand').checked == true) {totalscore +=1; }
                if (document.getElementById('medicaltrust').checked == true) {totalscore +=1; }
                if (document.getElementById('medicalchildcare').checked == true) {totalscore +=1; }
                if (document.getElementById('medicalother').checked == true) {totalscore +=1; }
                if (document.getElementById('dentistnoinsurance').checked == true) {totalscore +=1; }
                if (document.getElementById('dentistnoprovider').checked == true) {totalscore +=1; }
                if (document.getElementById('dentistnowork').checked == true) {totalscore +=1; }
                if (document.getElementById('dentistnoother').checked == true) {totalscore +=1; }
                if (document.getElementById('sociallessthan1').checked == true) {totalscore +=3; }
                if (document.getElementById('social1').checked == true) {totalscore +=2; }
                if (document.getElementById('social2to3').checked == true) {totalscore +=1; }
                if (document.getElementById('stresslevelsomewhat').checked == true) {totalscore +=1; }
                if (document.getElementById('stresslevelalot').checked == true) {totalscore +=2; }
                if (document.getElementById('stresslevelverymuch').checked == true) {totalscore +=3; }
                if (document.getElementById('stressdeath').checked == true) {totalscore +=5; }
                if (document.getElementById('stressdivorce').checked == true) {totalscore +=3; }
                if (document.getElementById('stressjob').checked == true) {totalscore +=3; }
                if (document.getElementById('stressmoved').checked == true) {totalscore +=2; }
                if (document.getElementById('stressillness').checked == true) {totalscore +=3; }
                if (document.getElementById('stressvictim').checked == true) {totalscore +=3; }
                if (document.getElementById('stresswitness').checked == true) {totalscore +=1; }
                if (document.getElementById('stresslegal').checked == true) {totalscore +=2; }
                if (document.getElementById('stresshomeless').checked == true) {totalscore +=3; }
                if (document.getElementById('stressincarcerated').checked == true) {totalscore +=3; }
                if (document.getElementById('stressbankruptcy').checked == true) {totalscore +=3; }
                if (document.getElementById('stressmarriage').checked == true) {totalscore +=1; }
                if (document.getElementById('stressbirth').checked == true) {totalscore +=1; }
                if (document.getElementById('stressadultchild').checked == true) {totalscore +=1; }
                if (document.getElementById('stressother').checked == true) {totalscore +=1; }
                if (document.getElementById('safeday').checked == true) {totalscore +=1; }
                if (document.getElementById('safeno').checked == true) {totalscore +=3; }
                if (document.getElementById('partnerunsafe').checked == true) {totalscore +=5; }
                if (document.getElementById('femaleyes').checked == true) {totalscore +=3; }
                if (document.getElementById('addictionyes').checked == true) {totalscore +=3; }
                if (document.getElementById('armedservicesyes').checked == true) {totalscore +=3; }
                if (document.getElementById('refugeeyes').checked == true) {totalscore +=5; }
                if (document.getElementById('discrimrace').checked == true) {totalscore +=5; }
                if (document.getElementById('discrimgender').checked == true) {totalscore +=2; }
                if (document.getElementById('discrimsexpref').checked == true) {totalscore +=3; }
                if (document.getElementById('discrimgenexp').checked == true) {totalscore +=3; }
                if (document.getElementById('discrimreligion').checked == true) {totalscore +=2; }
                if (document.getElementById('discrimdisability').checked == true) {totalscore +=3; }
                if (document.getElementById('discrimage').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimweight').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimses').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimedu').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimmarital').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimcitizen').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimaccent').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimcriminalhist').checked == true) {totalscore +=1; }
                if (document.getElementById('discrimother').checked == true) {totalscore +=1; }
                if (document.getElementById('displacework').checked == true) {totalscore +=1; }
                if (document.getElementById('displacehousing').checked == true) {totalscore +=1; }
                if (document.getElementById('displacehealth').checked == true) {totalscore +=1; }
                if (document.getElementById('displacelaw').checked == true) {totalscore +=1; }
                if (document.getElementById('displaceedu').checked == true) {totalscore +=1; }
                if (document.getElementById('displacepublic').checked == true) {totalscore +=1; }
                if (document.getElementById('displaceclubs').checked == true) {totalscore +=1; }
                if (document.getElementById('displacegovt').checked == true) {totalscore +=1; }
                if (document.getElementById('displacefinance').checked == true) {totalscore +=1; }
                if (document.getElementById('displaceother').checked == true) {totalscore +=1; }


                document.getElementById('totalscorerender').innerHTML = totalscore;
                document.getElementById('totalscore').value = totalscore;

            }
    </script>

</head>
<body>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2><?php echo xlt("Social Screening Tool");?></h2>
                <form method="post" action="<?php echo $rootdir;?>/forms/SDOH/save.php?mode=new" name="my_form" onsubmit="return top.restoreSession()">
                    <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
                    <fieldset>
                        <legend><?php echo xlt('What is the highest level of education that you have completed?')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="lessthanhs" value="lessthanhs" />
                                                <label class="form-check-label" for="lessthanhs"><?php echo xlt('Less than High School');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="highschool" value="highschool" />
                                                <label class="form-check-label" for="highschool"><?php echo xlt('High School Diploma or GED');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="associate" value="associate"/>
                                                <label class="form-check-label" for="associate"><?php echo xlt('2 Year College or Vocational Degree');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="bachelor" value="bachelor"/>
                                                <label class="form-check-label" for="bachelor"><?php echo xlt('Bachelors Degree');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="advanced" value="advanced"/>
                                                <label class="form-check-label" for="advanced"><?php echo xlt('Advanced Degree, Masters or Doctorate');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="education" id="edunotanswer" value="edunotanswer"/>
                                                <label class="form-check-label" for="edunotans"><?php echo xlt('Choose not to answer');?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Do you or any of your family members have a disability?')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-radio">
                                                <input type="radio" name="disability" id="disabilityyes" value="disabilityyes"/>
                                                <label class="form-check-label" for="disabilityyes"><?php echo xlt('Yes');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="disability" id="disabilityno" value="disabilityno" />
                                                <label class="form-check-label" for="disabilityno"><?php echo xlt('No');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="disability" id="disabilitynotans" value="disabilitynotans" />
                                                <label class="form-check-label" for="disabilitynotans"><?php echo xlt('Choose not to answer');?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('What is your housing situation today?')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="housepermanent" name='housepermament' value="housepermament" />
                                                <label class="form-check-label" for="housepermanent"><?php echo xlt('Permanent and Safe');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="housetemporary" name='housetemporary' value="housetemporary" />
                                                <label class="form-check-label" for="housetemporary"><?php echo xlt('Temporary (shelter, family, friends)');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="houseunsafe" name='houseunsafe' value="houseunsafe" />
                                                <label class="form-check-label" for="houseunsafe"><?php echo xlt('Unsafe housing (mold, exposure, unclean)');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="housecar" name='housecar' value="housecar" />
                                                <label class="form-check-label" for="housecar"><?php echo xlt('Car, van, or mobile home');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="houseunshelter" name='houseunshelter' value="houseunshelter" />
                                                <label class="form-check-label" for="houseunshelter"><?php echo xlt('Unsheltered (tent, park, vacant lot)');?></label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="houseother" name='houseother' value="houseother" />
                                                <label class="form-check-label" for="houseother"><?php echo xlt('Other:');?></label>
                                                <input type="text" id="housingotherinput" name='housingotherinput' size="30"/>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" name="housing" id="housenotans" name='housenotans' value="housenotans" />
                                                <label class="form-check-label" for="housenotans"><?php echo xlt('Choose not to answer');?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('What is your current work situation? Check all that apply.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workfulltime" name='workfulltime' />
                                                <label class="form-check-label" for="workfulltime"><?php echo xlt('Full Time');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workparttime" name='workparttime' />
                                                <label class="form-check-label" for="workparttime"><?php echo xlt('Part Time');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="worktemporary" name='worktemporary'  />
                                                <label class="form-check-label" for="worktemporary"><?php echo xlt('Temporary');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workseasonal" name='workseasonal' />
                                                <label class="form-check-label" for="workseasonal"><?php echo xlt('Seasonal or Migrant');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="worklooking" name='worklooking' />
                                                <label class="form-check-label" for="worklooking"><?php echo xlt('Looking for Work');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workretired" name='workretired' />
                                                <label class="form-check-label" for="workretired"><?php echo xlt('Retired');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workdisabled" name='workdisabled' />
                                                <label class="form-check-label" for="workdisabled"><?php echo xlt('Disabled');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="workstudent" name='workstudent'  />
                                                <label class="form-check-label" for="workstudent"><?php echo xlt('Student');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="worknotemployed" name='worknotemployed' />
                                                <label class="form-check-label" for="worknotemployed"><?php echo xlt('Not Employed Outside the Home');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="worknotans" name='worknotans' />
                                                <label class="form-check-label" for="worknotans"><?php echo xlt('Choose not to answer');?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('How many hours do you work in a week?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-number">
                                            <input type="number" id="workhours" name='workhours' min="0" max="200"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('What is the total income for all your family in the past year? (This will help us know if you are eligible for benefits)')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-number">
                                            <input type="number" id="hhincome" name='hhincome' min="0" max="10000000"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('How many people are in your household? Including yourself.')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-number">
                                            <input type="number" id="hhsize" name='hhsize' min="1" max="20"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Are you a primary caregiver for any of the following? Check all that aplly.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="careno" name='careno'  />
                                                <label class="form-check-label" for="careno"><?php echo xlt('Not a primary caregiver');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="careunder5" name='careunder5' />
                                                <label class="form-check-label" for="careunder5"><?php echo xlt('Children under 5');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="care5to12" name='care5to12' />
                                                <label class="form-check-label" for="care5to12"><?php echo xlt('Children age 5 to 12');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="careover12" name='careover12' />
                                                <label class="form-check-label" for="careover12"><?php echo xlt('Children over 12');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="carespecneeds" name='carespecneeds'  />
                                                <label class="form-check-label" for="carespecneeds"><?php echo xlt('Special Needs Child');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="caredisabled" name='caredisabled' />
                                                <label class="form-check-label" for="caredisabled"><?php echo xlt('Disabled or Ill Adult');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="careelderly" name='careelderly' />
                                                <label class="form-check-label" for="careelderly"><?php echo xlt('Elderly');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="careother" name='careother' />
                                                <label class="form-check-label" for="careother"><?php echo xlt('Other');?></label>
                                                <input type="text" id="careotherinput" name='careotherinput' size="30"/>
                                            </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Do you or a family member owe money that you struggle to pay back? Check all that apply.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtno" name='debtno' />
                                                <label class="form-check-label" for="debtno"><?php echo xlt('No debt');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtmedical" name='debtmedical' />
                                                <label class="form-check-label" for="debtmedical"><?php echo xlt('Medical Bills');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtcreditcards" name='debtcreditcards' />
                                                <label class="form-check-label" for="debtcreditcards"><?php echo xlt('Credit Cards');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtrent" name='debtrent' />
                                                <label class="form-check-label" for="debtrent"><?php echo xlt('Rent/Mortgage');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtstudentloans" name='debtstudentloans' />
                                                <label class="form-check-label" for="debtstudentloans"><?php echo xlt('Student Loans');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debttaxes" name='debttaxes' />
                                                <label class="form-check-label" for="debttaxes"><?php echo xlt('Taxes');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtlegal" name='debtlegal' />
                                                <label class="form-check-label" for="debtlegal"><?php echo xlt('Legal Fees');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtcar" name='debtcar' />
                                                <label class="form-check-label" for="debtcar"><?php echo xlt('Car Loan or License');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtutilities" name='debtutilities' />
                                                <label class="form-check-label" for="debtutilities"><?php echo xlt('Utilities');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="debtother" name='debtother' />
                                                <label class="form-check-label" for="debtother"><?php echo xlt('Other');?></label>
                                                <input type="text" id="debtotherinput" name='debtotherinput' size="30"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you or a family member struggled to pay for any of the following? Check all that apply.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyno" name='moneyno' />
                                                <label class="form-check-label" for="moneyno"><?php echo xlt('No Financial Struggles');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyfood" name='moneyfood' />
                                                <label class="form-check-label" for="moneyfood"><?php echo xlt('Healthy Food');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneymedical" name='moneymedical' />
                                                <label class="form-check-label" for="moneymedical"><?php echo xlt('Medicine or Medical Care');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneychildcare" name='moneychildcare' />
                                                <label class="form-check-label" for="moneychildcare"><?php echo xlt('Child Care or School');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyutilities" name='moneyutilities' />
                                                <label class="form-check-label" for="moneyutilities"><?php echo xlt('Utilities (Power, water)');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyphone" name='moneyphone' />
                                                <label class="form-check-label" for="moneyphone"><?php echo xlt('Phone, Internet');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyrent" name='moneyrent' />
                                                <label class="form-check-label" for="moneyrent"><?php echo xlt('Rent or Mortgage');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneytransportation" name='moneytransportation' />
                                                <label class="form-check-label" for="moneytransportation"><?php echo xlt('Transportation');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyclothing" name='moneyclothing' />
                                                <label class="form-check-label" for="moneyclothing"><?php echo xlt('Clothing');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyeducation" name='moneyeducation' />
                                                <label class="form-check-label" for="moneyeducation"><?php echo xlt('Education');?></label>
                                            </div>
                                             <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="moneyother" name='moneyother' />
                                                <label class="form-check-label" for="moneyother"><?php echo xlt('Other');?></label>
                                                 <input type="text" id="moneyotherinput" name='moneyotherinput' size="30"/>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, has lack of transportation prevented you or a family member from any of the following? Check all that apply.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportationno" name='transportationno' />
                                                <label class="form-check-label" for="transportationno"><?php echo xlt('No Transportation Problems');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportmedical" name='transportmedical' />
                                                <label class="form-check-label" for="transportmedical"><?php echo xlt('Medical Care');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportfood" name='transportfood' />
                                                <label class="form-check-label" for="transportfood"><?php echo xlt('Access to Healthy Food');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportwork" name='transportwork' />
                                                <label class="form-check-label" for="transportwork"><?php echo xlt('Work or Meetings');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportschool" name='transportschool' />
                                                <label class="form-check-label" for="transportschool"><?php echo xlt('School or Childcare');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportfamily" name='transportfamily' />
                                                <label class="form-check-label" for="transportfamily"><?php echo xlt('Visit Family or Friends');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="transportother" name='transportother' />
                                                <label class="form-check-label" for="transportother"><?php echo xlt('Other');?></label>
                                                <input type="text" id="transportotherinput" name='transportotherinput' size="30"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you or a family member not gotten medical care because of any of the following? Check all that apply.')?></legend>
                        <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalno" name='medicalno' />
                                                <label class="form-check-label" for="medicalno"><?php echo xlt('No delayed medical care');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalnoinsurance" name='medicalnoinsurance' />
                                                <label class="form-check-label" for="medicalnoinsurance"><?php echo xlt('No Insurance');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalcopay" name='medicalcopay' />
                                                <label class="form-check-label" for="medicalcopay"><?php echo xlt('Copay or Deductible is too high');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalnotcovered" name='medicalnotcovered' />
                                                <label class="form-check-label" for="medicalnotcovered"><?php echo xlt('Needed care is not covered by insurance');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalwork" name='medicalwork' />
                                                <label class="form-check-label" for="medicalwork"><?php echo xlt('Not able to take time off work');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalnoprovider" name='medicalnoprovider' />
                                                <label class="form-check-label" for="medicalnoprovider"><?php echo xlt('No provider available');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicalunderstand" name='medicalunderstand' />
                                                <label class="form-check-label" for="medicalunderstand"><?php echo xlt('Did not understand provider recommendations');?></label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="medicaltrust" name='medicaltrust' />
                                                <label class="form-check-label" for="medicaltrust"><?php echo xlt('Lack of trust in medical care');?></label>
                                            </div>
                                            <div class="form-check">
                                                 <input type="checkbox" class="form-check-input" id="medicalchildcare" name='medicalchildcare' />
                                                 <label class="form-check-label" for="medicalchildcare"><?php echo xlt('No child care');?></label>
                                            </div>
                                            <div class="form-check">
                                                 <input type="checkbox" class="form-check-input" id="medicalother" name='medicalother' />
                                                 <label class="form-check-label" for="medicalother"><?php echo xlt('Other');?></label>
                                                <input type="text" id="medicalotherinput" name='medicalotherinput' size="30"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you and your family members seen dentists?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistyes" value="dentistyes" />
                                            <label class="form-check-label" for="dentistyes"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistnoinsurance" value="dentistnoinsurance" />
                                            <label class="form-check-label" for="dentistnoinsurance"><?php echo xlt('No, not insured');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistnoprovider" value="dentistnoprovider" />
                                            <label class="form-check-label" for="dentistnoprovider"><?php echo xlt('No, need dentist');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistnowork" value="dentistnowork" />
                                            <label class="form-check-label" for="dentistnowork"><?php echo xlt('No, not able to take time off work');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistnoother" value="dentistnoother" />
                                            <label class="form-check-label" for="dentistnoother"><?php echo xlt('No, other');?></label>
                                            <input type="text" id="dentistotherinput" name='dentistotherinput' size="30"/>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="dentist" id="dentistnotans" value="dentistnotans" />
                                            <label class="form-check-label" for="dentistnotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('How often do you see or talk to people that you care about or feel close to?  (For example: talking to friends on the phone, visiting friends or family, going to church or club meetings)')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="sociallessthan1" value="sociallessthan1" />
                                            <label class="form-check-label" for="sociallessthan1"><?php echo xlt('Less than once a week');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="social1" value= "social1" />
                                            <label class="form-check-label" for="social1"><?php echo xlt('1 time a week');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="social2to3" value="social2to3" />
                                            <label class="form-check-label" for="social2to3"><?php echo xlt('2-3 times a week');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="social4to5" value="social4to5" />
                                            <label class="form-check-label" for="social4to5"><?php echo xlt('4-5 times a week');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="socialdaily" value="socialdaily" />
                                            <label class="form-check-label" for="socialdaily"><?php echo xlt('Almost every day');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="social" id="socialnotans" value="socialnotans" />
                                            <label class="form-check-label" for="socialnotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Stress is when someone feels tense, nervous, anxious, or can’t sleep at night because their mind is troubled. How stressed are you?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevelno" value="stresslevelno" />
                                            <label class="form-check-label" for="stresslevelno"><?php echo xlt('Not at all');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevellittle" value="stresslevellittle" />
                                            <label class="form-check-label" for="stresslevellittle"><?php echo xlt('A little bit');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevelsomewhat" value="stresslevelsomewhat" />
                                            <label class="form-check-label" for="stresslevelsomewhat"><?php echo xlt('Somewhat');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevelalot" value="stresslevelalot" />
                                            <label class="form-check-label" for="stresslevelalot"><?php echo xlt('Quite a bit');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevelverymuch" value="stresslevelverymuch" />
                                            <label class="form-check-label" for="stresslevelverymuch"><?php echo xlt('Very Much');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="stress" id="stresslevelnotans" value="stresslevelnotans" />
                                            <label class="form-check-label" for="stresslevelnotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you had any of the following stressful life events occur? Check all that apply.')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressno" name='stressno' />
                                            <label class="form-check-label" for="stressno"><?php echo xlt('No Stressful Life Events');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressdeath" name='stressdeath' />
                                            <label class="form-check-label" for="stressdeath"><?php echo xlt('Death of a loved one');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressdivorce" name='stressdivorce' />
                                            <label class="form-check-label" for="stressdivorce"><?php echo xlt('Divorce or separation');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressjob" name='stressjob' />
                                            <label class="form-check-label" for="stressjob"><?php echo xlt('Loss of job');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressmoved" name='stressmoved' />
                                            <label class="form-check-label" for="stressmoved"><?php echo xlt('Moved');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressillness" name='stressillness' />
                                            <label class="form-check-label" for="stressillness"><?php echo xlt('Major illness or injury');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressvictim" name='stressvictim' />
                                            <label class="form-check-label" for="stressvictim"><?php echo xlt('Victim of a crime');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stresswitness" name='stresswitness' />
                                            <label class="form-check-label" for="stresswitness"><?php echo xlt('Witness of a crime or accident');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stresslegal" name='stresslegal' />
                                            <label class="form-check-label" for="stresslegal"><?php echo xlt('Legal Issues');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stresshomeless" name='stresshomeless' />
                                            <label class="form-check-label" for="stresshomeless"><?php echo xlt('Homeless');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressincarcerated" name='stressincarcerated' />
                                            <label class="form-check-label" for="stressincarcerated"><?php echo xlt('Incarcerated');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressbankruptcy" name='stressbankruptcy' />
                                            <label class="form-check-label" for="stressbankruptcy"><?php echo xlt('Bankruptcy');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressmarriage" name='stressmarriage' />
                                            <label class="form-check-label" for="stressmarriage"><?php echo xlt('Marriage');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressbirth" name='stressbirth' />
                                            <label class="form-check-label" for="stressbirth"><?php echo xlt('Birth of a child');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressadultchild" name='stressadultchild' />
                                            <label class="form-check-label" for="stressadultchild"><?php echo xlt('Child moving out');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="stressother" name='stressother' />
                                            <label class="form-check-label" for="stressother"><?php echo xlt('Other');?></label>
                                            <input type="text" id="stressotherinput" name='stressotherinput' size="30"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Do you feel safe walking and living in your neighborhood?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="safety" id="safeyes" value="safeyes" />
                                            <label class="form-check-label" for="safeyes"><?php echo xlt('Yes, all the time');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="safety" id="safeday" value="safeday" />
                                            <label class="form-check-label" for="safeday"><?php echo xlt('Yes, during the day');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="safety" id="safeno" value="safeno" />
                                            <label class="form-check-label" for="safeno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="safety" id="safenotans" value="safenotans" />
                                            <label class="form-check-label" for="safenotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you or a family member been afraid of a partner or ex-partner?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="partnersafety" id="partnerunsafe" value="partnerunsafe" />
                                            <label class="form-check-label" for="partnerunsafe"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="partnersafety" id="partnersafe" value="partnersafe" />
                                            <label class="form-check-label" for="partnersafe"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="partnersafety" id="partnernotans" value="partnernotans" />
                                            <label class="form-check-label" for="partnernotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you been a female headed household?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="female" id="femaleyes" value="femaleyes" />
                                            <label class="form-check-label" for="femaleyes"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="female" id="femaleno" value="femaleno" />
                                            <label class="form-check-label" for="femaleno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="female" id="femalenotans" value="femalenotans" />
                                            <label class="form-check-label" for="femalenotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you or anyone in your family struggled with addiction?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="addiction" id="addictionyes" value="addictionyes" />
                                            <label class="form-check-label" for="addictionyes"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="addiction" id="addictionno" value="addictionno" />
                                            <label class="form-check-label" for="addictionno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="addiction" id="addictionnotans" value="addictionnotans" />
                                            <label class="form-check-label" for="addictionnotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Have you ever been discharged from the Armed Services?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="armedservices" id="armedservicesyes" value="armedservicesyes" />
                                            <label class="form-check-label" for="armedservicesyes"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="armedservices" id="armedservicesno" value="armedservicesno" />
                                            <label class="form-check-label" for="armedservicesno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="armedservices" id="armedservicesnotans" value="armedservicesnotans" />
                                            <label class="form-check-label" for="armedservicesnotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Are you a refugee?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="refugee" id="refugeeyes" value="refugeeyes" />
                                            <label class="form-check-label" for="refugeeyes"><?php echo xlt('Yes');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="refugee" id="refugeeno" value="refugeeno" />
                                            <label class="form-check-label" for="refugeeno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="refugee" id="refugeenotans" value="refugeenotans" />
                                            <label class="form-check-label" for="refugeenotans"><?php echo xlt('Choose not to answer');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In the past year, have you been discriminated against because of any of the following? Check all that apply.')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimno" name='discrimno' />
                                            <label class="form-check-label" for="discrimno"><?php echo xlt('No Discrimination');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimrace" name='discrimrace' />
                                            <label class="form-check-label" for="discrimrace"><?php echo xlt('Race/Ethnicity');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimgender" name='discrimgender' />
                                            <label class="form-check-label" for="discrimgender"><?php echo xlt('Gender');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimsexpref" name='discrimsexpref' />
                                            <label class="form-check-label" for="discrimsexpref"><?php echo xlt('Sexual Preference');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimgenexp" name='discrimgenexp' />
                                            <label class="form-check-label" for="discrimgenexp"><?php echo xlt('Gender Expression');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimreligion" name='discrimreligion' />
                                            <label class="form-check-label" for="discrimreligion"><?php echo xlt('Religion');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimdisability" name='discrimdisability' />
                                            <label class="form-check-label" for="discrimdisability"><?php echo xlt('Disability');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimage" name='discrimage' />
                                            <label class="form-check-label" for="discrimage"><?php echo xlt('Age');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimweight" name='discrimweight' />
                                            <label class="form-check-label" for="discrimweight"><?php echo xlt('Weight');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimses" name='discrimses' />
                                            <label class="form-check-label" for="discrimses"><?php echo xlt('Socioeconomic Status');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimedu" name='discrimedu' />
                                            <label class="form-check-label" for="discrimedu"><?php echo xlt('Education');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimmarital" name='discrimmarital' />
                                            <label class="form-check-label" for="discrimmarital"><?php echo xlt('Marital Status');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimcitizen" name='discrimcitizen' />
                                            <label class="form-check-label" for="discrimcitizen"><?php echo xlt('Citizenship');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimaccent" name='discrimaccent' />
                                            <label class="form-check-label" for="discrimaccent"><?php echo xlt('Accent or Language');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimcriminalhist" name='discrimcriminalhist' />
                                            <label class="form-check-label" for="discrimcriminalhist"><?php echo xlt('Criminal History');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="discrimother" name='discrimother' />
                                            <label class="form-check-label" for="discrimother"><?php echo xlt('Other');?></label>
                                            <input type="text" id="discrimotherinput" name='discrimotherinput' size="30"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('In what situations have you been discriminated in? Check all that apply.')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displaceno" name='displaceno' />
                                            <label class="form-check-label" for="displaceno"><?php echo xlt('No Discrimination');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacework" name='displacework' />
                                            <label class="form-check-label" for="displacework"><?php echo xlt('Employment');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacehousing" name='displacehousing' />
                                            <label class="form-check-label" for="displacehousing"><?php echo xlt('Housing');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacehealth" name='displacehealth' />
                                            <label class="form-check-label" for="displacehealth"><?php echo xlt('Health Care');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacelaw" name='displacelaw' />
                                            <label class="form-check-label" for="displacelaw"><?php echo xlt('Law Enforcement');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displaceedu" name='displaceedu' />
                                            <label class="form-check-label" for="displaceedu"><?php echo xlt('Education');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacepublic" name='displacepublic' />
                                            <label class="form-check-label" for="displacepublic"><?php echo xlt('In Public (Shopping, Dining, Parks)');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displaceclubs" name='displaceclubs' />
                                            <label class="form-check-label" for="displaceclubs"><?php echo xlt('Religious or Civic Organizations');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacegovt" name='displacegovt' />
                                            <label class="form-check-label" for="displacegovt"><?php echo xlt('Government');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displacefinance" name='displacefinance' />
                                            <label class="form-check-label" for="displacefinance"><?php echo xlt('Banks or Finance Services');?></label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="displaceother" name='displaceother' />
                                            <label class="form-check-label" for="displaceother"><?php echo xlt('Other');?></label>
                                            <input type="text" id="displaceotherinput" name='displaceotherinput' size="30"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Would you like to be contacted with resources or assistance?')?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <input type="radio" name="contact" id="contactphone" value="contactphone" />
                                            <label class="form-check-label" for="contactphone"><?php echo xlt('Yes, by phone');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="contact" id="contactemail" value="contactemail" />
                                            <label class="form-check-label" for="contactemail"><?php echo xlt('Yes, by email');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="contact" id="contactportal" value="contactportal" />
                                            <label class="form-check-label" for="contactportal"><?php echo xlt('Yes, by portal message');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="contact" id="contactno" value="contactno" />
                                            <label class="form-check-label" for="contactno"><?php echo xlt('No');?></label>
                                        </div>
                                        <div class="form-radio">
                                            <input type="radio" name="contact" id="contactother" value="contactother" />
                                            <label class="form-check-label" for="contactother"><?php echo xlt('Other');?></label>
                                            <input type="text" id="contactotherinput" name='contactotherinput' size="30"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Your total score is ')?><span id="totalscorerender"></span></legend>
                        <input type="hidden" id="totalscore" name="totalscore" value="">


                    </fieldset>
                    <fieldset>
                        <legend><?php echo xlt('Other Comments');?></legend>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="additional_notes" class="form-control" cols="80" rows="5" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 position-override">
                                <div class="btn-group" role="group">
                                    <button type="submit" onclick="top.restoreSession()" class="btn btn-primary btn-save"><?php echo xlt('Save'); ?></button>
                                    <button type="button" class="btn btn-secondary btn-cancel" onclick="top.restoreSession(); parent.closeTab(window.name, false);"><?php echo xlt('Cancel');?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
