<?php

/**
 * sdoh form
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once(dirname(__FILE__) . '/../../globals.php');
require_once($GLOBALS["srcdir"] . "/api.inc");

function sdoh_report($pid, $encounter, $cols, $id)
{
    $count = 0;
    $data = formFetch("form_sdoh", $id);
    if ($data) {
        print "<table><tr>";


        $sdohData = [];
        foreach ($data as $key => $value) {
            if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
                continue;
            }

            $sdohData[$key] = $value;


            //modified by BM 07-2009 for internationalization
           // if ($key == "Additional Notes") {
            //        print "<td><span class=bold>" . xlt($key) . ": </span><span class=text>" . text($value) . "</span></td>";
           // } else {
           //         print "<td><span class=bold>" . xlt($key) . ": </span><span class=text>" . xlt($value) . "</span></td>";
           // }

            //$count++;
            //if ($count == $cols) {
            //   $count = 0;
            // print "</tr><tr>\n";
            //}
        }

        if (empty($sdohData['totalscore'])) {
            echo "<tr></tr><td><span class=bold>" . xlt("No Social Screening Risks") . "</span></td></tr>";
        } else {
            echo "<tr></tr><td><span class=bold>" . xlt("Social Screening Risks:") . "</span></td></tr>";

            if ($sdohData['education'] == 'lessthanhs') {
                echo "<tr></tr><td><span class=text>" . xlt("Less than High School Education") . "</span></td></tr>";
            }
            if ($sdohData['education'] == 'highschool') {
                echo "<tr></tr><td><span class=text>" . xlt("High School Diploma or GED") . "</span></td></tr>";
            }
            if ($sdohData['education'] == 'associate') {
                echo "<tr></tr><td><span class=text>" . xlt("Some College") . "</span></td></tr>";
            }
            if ($sdohData['disability'] == 'disabilityyes') {
                echo "<tr></tr><td><span class=text>" . xlt("Disability Self or Family") . "</span></td></tr>";
            }
            if ($sdohData['housing'] == 'housetemporary') {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability: Temporary(Shelter, Friends, Family)") . "</span></td></tr>";
            }
            if ($sdohData['housing'] == 'houseunsafe') {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability: Unsafe (Mold, Exposure)") . "</span></td></tr>";
            }
            if ($sdohData['housing'] == 'housecar') {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability: Car, van, mobile home") . "</span></td></tr>";
            }
            if ($sdohData['housing'] == 'houseunshelter') {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability: Unsheltered") . "</span></td></tr>";
            }
            if ($sdohData['housing'] == 'houseother') {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability: ") . $sdohData['houseotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['worktemporary'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Employment Insecurity: Temporary") . "</span></td></tr>";
            }
            if ($sdohData['workseasonal'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Employment Insecurity: Seasonal or Migrant") . "</span></td></tr>";
            }
            if ($sdohData['worklooking'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Employment Insecurity: Looking for Work") . "</span></td></tr>";
            }
            if ($sdohData['workretired'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Employment Insecurity: Retired") . "</span></td></tr>";
            }
            if ($sdohData['workdisabled'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Employment Insecurity: Disabled") . "</span></td></tr>";
            }
            if ($sdohData['workhours'] > 40) {
                echo "<tr></tr><td><span class=text>" . xlt("Over 40 Work Hours: ") .  $sdohData['workhours'] . "</span></td></tr>";
            }
            if ($sdohData['hhincome']/$sdohData['hhsize'] < 25000) {
                echo "<tr></tr><td><span class=text>" . xlt("Potential Low Income. Household Size: ") .  $sdohData['hhsize'] . xlt("  Household Income: ") .  $sdohData['hhincome'] . "</span></td></tr>";
            }
            if ($sdohData['careunder5'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Children Under 5") . "</span></td></tr>";
            }
            if ($sdohData['care5to12'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Children 5 to 12") . "</span></td></tr>";
            }
            if ($sdohData['careover12'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Children over 12") . "</span></td></tr>";
            }
            if ($sdohData['carespecneeds'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Special Needs Child") . "</span></td></tr>";
            }
            if ($sdohData['caredisabled'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Disabled or Ill Adult") . "</span></td></tr>";
            }
            if ($sdohData['careelderly'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Elderly") . "</span></td></tr>";
            }
            if ($sdohData['careother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver for Other: ") . $sdohData['careotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['debtmedical'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Medical Bills") . "</span></td></tr>";
            }
            if ($sdohData['debtcreditcards'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Credit Cards") . "</span></td></tr>";
            }
            if ($sdohData['debtrent'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Rent or Mortgage") . "</span></td></tr>";
            }
            if ($sdohData['debtstudentloans'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Student Loans") . "</span></td></tr>";
            }
            if ($sdohData['debttaxes'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Taxes") . "</span></td></tr>";
            }
            if ($sdohData['debtlegal'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Legal Issues") . "</span></td></tr>";
            }
            if ($sdohData['debtcar'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Car Loan or Tickets") . "</span></td></tr>";
            }
            if ($sdohData['debtutilities'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Utilities or Phone") . "</span></td></tr>";
            }
            if ($sdohData['debtother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Debt for Other: ") . $sdohData['debtotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['moneyfood'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Healthy Food") . "</span></td></tr>";
            }
            if ($sdohData['moneymedical'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Medicine or Medical Care") . "</span></td></tr>";
            }
            if ($sdohData['moneychildcare'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Childcare") . "</span></td></tr>";
            }
            if ($sdohData['moneyutilities'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Utilities") . "</span></td></tr>";
            }
            if ($sdohData['moneyphone'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Phone or Internet") . "</span></td></tr>";
            }
            if ($sdohData['moneyrent'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Rent or Mortgage") . "</span></td></tr>";
            }
            if ($sdohData['moneytransportation'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Transportation") . "</span></td></tr>";
            }
            if ($sdohData['moneyclothing'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Clothing") . "</span></td></tr>";
            }
            if ($sdohData['moneyeducation'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Clothing") . "</span></td></tr>";
            }
            if ($sdohData['moneyother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Struggle to pay for Other: ") . $sdohData['moneyotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['transportmedical'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for Medical Care") . "</span></td></tr>";
            }
            if ($sdohData['transportfood'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for Healthy Food") . "</span></td></tr>";
            }
            if ($sdohData['transportwork'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for Work or Meetings") . "</span></td></tr>";
            }
            if ($sdohData['transportschool'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for School or Childcare") . "</span></td></tr>";
            }
            if ($sdohData['transportfamily'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for Visiting Family or Friends") . "</span></td></tr>";
            }
            if ($sdohData['transportother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity for Other: ") . $sdohData['transportotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['medicalnoinsurance'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to No Insurance") . "</span></td></tr>";
            }
            if ($sdohData['medcialcopay'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to High Copay or Deductible") . "</span></td></tr>";
            }
            if ($sdohData['medicalnotcovered'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to Specified Care Not Covered") . "</span></td></tr>";
            }
            if ($sdohData['medicalwork'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to Inflexible Work Schedule") . "</span></td></tr>";
            }
            if ($sdohData['medicalnoprovider'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to No Provider Available") . "</span></td></tr>";
            }
            if ($sdohData['medicalunderstand'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to Not Understanding Care Plan") . "</span></td></tr>";
            }
            if ($sdohData['medicaltrust'] == 'pm') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to Lack of Trust in Provider") . "</span></td></tr>";
            }
            if ($sdohData['medicalchildcare'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to No Childcare") . "</span></td></tr>";
            }
            if ($sdohData['medicalother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Delayed Medical Care due to Other: ") . $sdohData['medicalotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['dentist'] == 'dentistnoinsurance') {
                echo "<tr></tr><td><span class=text>" . xlt("No Dental Insurance") . "</span></td></tr>";
            }
            if ($sdohData['dentist'] == 'dentistnoprovider') {
                echo "<tr></tr><td><span class=text>" . xlt("No Dentist") . "</span></td></tr>";
            }
            if ($sdohData['dentist'] == 'dentistnowork') {
                echo "<tr></tr><td><span class=text>" . xlt("No Dental Care due to Work Schedule") . "</span></td></tr>";
            }
            if ($sdohData['dentist'] == 'dentistnoother') {
                echo "<tr></tr><td><span class=text>" . xlt("No Dental Care due to Other: ") . $sdohData['dentalotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['social'] == 'sociallessthan1') {
                echo "<tr></tr><td><span class=text>" . xlt("Social Connection Less than Once a Week") . "</span></td></tr>";
            }
            if ($sdohData['social'] == 'social1') {
                echo "<tr></tr><td><span class=text>" . xlt("Social Connection Only Once a Week") . "</span></td></tr>";
            }
            if ($sdohData['social'] == 'social2to3') {
                echo "<tr></tr><td><span class=text>" . xlt("Social Connection Only 2 to 3 Times a Week") . "</span></td></tr>";
            }
            if ($sdohData['stress'] == 'stresslevelsomewhat') {
                echo "<tr></tr><td><span class=text>" . xlt("Somewhat Stressed") . "</span></td></tr>";
            }
            if ($sdohData['stress'] == 'stresslevelalot') {
                echo "<tr></tr><td><span class=text>" . xlt("Quite a Bit Stressed") . "</span></td></tr>";
            }
            if ($sdohData['stress'] == 'stresslevelverymuch') {
                echo "<tr></tr><td><span class=text>" . xlt("Very Much Stressed") . "</span></td></tr>";
            }
            if ($sdohData['stressdeath'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Death of a Loved One") . "</span></td></tr>";
            }
            if ($sdohData['stressdivorce'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Divorce or Separation") . "</span></td></tr>";
            }
            if ($sdohData['stressjob'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Loss of Job") . "</span></td></tr>";
            }
            if ($sdohData['stressmoved'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Moved") . "</span></td></tr>";
            }
            if ($sdohData['stressillness'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Major Illness or Accident") . "</span></td></tr>";
            }
            if ($sdohData['stressvictim'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Victim of Crime") . "</span></td></tr>";
            }
            if ($sdohData['stresswitness'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Witness of Crime or Accident") . "</span></td></tr>";
            }
            if ($sdohData['stresslegal'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Legal Issues") . "</span></td></tr>";
            }
            if ($sdohData['stresshomeless'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Loss of Housing") . "</span></td></tr>";
            }
            if ($sdohData['stressincarcerated'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Incarcerated") . "</span></td></tr>";
            }
            if ($sdohData['stressbankruptcy'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Bankruptcy") . "</span></td></tr>";
            }
            if ($sdohData['stressmarriage'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Marriage") . "</span></td></tr>";
            }
            if ($sdohData['stressbirth'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Birth of Child") . "</span></td></tr>";
            }
            if ($sdohData['stressadultchild'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: Child Moving Out") . "</span></td></tr>";
            }
            if ($sdohData['stressother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Stress Event: (Other) ") .  $sdohData['stressotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['safety'] == 'safeday') {
                echo "<tr></tr><td><span class=text>" . xlt("Unsafe Neighborhood at Night") . "</span></td></tr>";
            }
            if ($sdohData['safety'] == 'safeno') {
                echo "<tr></tr><td><span class=text>" . xlt("Unsafe Neighborhood") . "</span></td></tr>";
            }
            if ($sdohData['partnersafety'] == 'partnerunsafe') {
                echo "<tr></tr><td><span class=text>" . xlt("Intimate Partner Violence for Self or Family") . "</span></td></tr>";
            }
            if ($sdohData['female'] == 'femaleyes') {
                echo "<tr></tr><td><span class=text>" . xlt("Female Headed Household") . "</span></td></tr>";
            }
            if ($sdohData['addiction'] == 'addictionyes') {
                echo "<tr></tr><td><span class=text>" . xlt("Addiction with Self or Family") . "</span></td></tr>";
            }
            if ($sdohData['armedservices'] == 'aremedservicesyes') {
                echo "<tr></tr><td><span class=text>" . xlt("Discharged from Armed Services") . "</span></td></tr>";
            }
            if ($sdohData['refugee'] == 'refugeeyes') {
                echo "<tr></tr><td><span class=text>" . xlt("Refugee") . "</span></td></tr>";
            }
            if ($sdohData['discrimrace'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Race and/or Ethnicity") . "</span></td></tr>";
            }
            if ($sdohData['disrimgender'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Gender") . "</span></td></tr>";
            }
            if ($sdohData['discrimsexpre'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Sexual Preference") . "</span></td></tr>";
            }
            if ($sdohData['discrimgenexp'] == '') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Gender Expression") . "</span></td></tr>";
            }
            if ($sdohData['discrimreligion'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Religion") . "</span></td></tr>";
            }
            if ($sdohData['discrimdisability'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Disability") . "</span></td></tr>";
            }
            if ($sdohData['discrimage'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Age") . "</span></td></tr>";
            }
            if ($sdohData['discrimweight'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Weight") . "</span></td></tr>";
            }
            if ($sdohData['discrimses'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Socioeconomic Status") . "</span></td></tr>";
            }
            if ($sdohData['discrimedu'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Education Level") . "</span></td></tr>";
            }
            if ($sdohData['discrimmarital'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Marital Status") . "</span></td></tr>";
            }
            if ($sdohData['discrimcitizen'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Citenzenship Status") . "</span></td></tr>";
            }
            if ($sdohData['discrimaccent'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Accent or Language") . "</span></td></tr>";
            }
            if ($sdohData['discrimcriminalhist'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Criminal History") . "</span></td></tr>";
            }
            if ($sdohData['discrimother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination for Other: ") . $sdohData['discrimotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['displacework'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated at Work") . "</span></td></tr>";
            }
            if ($sdohData['displacehousing'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Housing ") . "</span></td></tr>";
            }
            if ($sdohData['displacehealth'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Health Care") . "</span></td></tr>";
            }
            if ($sdohData['displacelaw'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Law Enforcement") . "</span></td></tr>";
            }
            if ($sdohData['displaceedu'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Education ") . "</span></td></tr>";
            }
            if ($sdohData['displacepublic'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Public(Shopping, Dining, Walking)") . "</span></td></tr>";
            }
            if ($sdohData['displaceclubs'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Religious or Civic Clubs or Organizations") . "</span></td></tr>";
            }
            if ($sdohData['displacefinance'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Banking or Finance Services") . "</span></td></tr>";
            }
            if ($sdohData['displaceother'] == 'on') {
                echo "<tr></tr><td><span class=text>" . xlt("Discriminated in Other: ") . $sdohData['discrimotherinput'] . "</span></td></tr>";
            }
            if ($sdohData['contact'] == 'contactphone') {
                echo "<tr></tr><td><span class=bold>" . xlt("Contact by Phone with Resources") . "</span></td></tr>";
            }
            if ($sdohData['contact'] == 'contactemail') {
                echo "<tr></tr><td><span class=bold>" . xlt("Contact by Email with Resources") . "</span></td></tr>";
            }
            if ($sdohData['contact'] == 'contactportal') {
                echo "<tr></tr><td><span class=bold>" . xlt("Contact through Patient Portal with Resources") . "</span></td></tr>";
            }
            if ($sdohData['contact'] == 'contactno') {
                echo "<tr></tr><td><span class=bold>" . xlt("Do Not Contact With Resources") . "</span></td></tr>";
            }
            if ($sdohData['contact'] == 'contactother') {
                echo "<tr></tr><td><span class=bold>" . xlt("Contact with Resources via Other: ") . $sdohData['discrimotherinput'] . "</span></td></tr>";
            }

            echo "<tr></tr><td><span class=text>" . xlt("Patient Score = ") . $sdohData['totalscore'] . "</span></td></tr>";

            echo "<tr></tr><td><span class=bold>" . xlt("Possible Diagnoses:") . "</span></td></tr>";

            if ($sdohData['debtmedical'] == 'on'
            || $sdohData['debtcreditcards'] == 'on'
            || $sdohData['debtrent'] == 'on'
            || $sdohData['debtstudentloans'] == 'on'
            || $sdohData['debttaxes'] == 'on'
            || $sdohData['debtlegal'] == 'on'
            || $sdohData['debtcar'] == 'on'
            || $sdohData['debtutilities'] == 'on'
            || $sdohData['debtother'] == 'on'
            || $sdohData['moneyfood'] == 'on'
            || $sdohData['moneymedical'] == 'on'
            || $sdohData['moneychildcare'] == 'on'
            || $sdohData['moneyutilities'] == 'on'
            || $sdohData['moneyphone'] == 'on'
            || $sdohData['moneyrent'] == 'on'
            || $sdohData['moneytransportation'] == 'on'
            || $sdohData['moneyclothing'] == 'on'
            || $sdohData['moneyeducation'] == 'on'
            || $sdohData['moneyother'] == 'on'
            || $sdohData['stressbankruptcy'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Financial Insecurity") . "</span></td></tr>";
            }

            if ($sdohData['moneyfood'] == 'on'
            || $sdohData['moneymedical'] == 'on'
            || $sdohData['moneychildcare'] == 'on'
            || $sdohData['moneyutilities'] == 'on'
            || $sdohData['moneyphone'] == 'on'
            || $sdohData['moneyrent'] == 'on'
            || $sdohData['moneytransportation'] == 'on'
            || $sdohData['moneyclothing'] == 'on'
            || $sdohData['moneyeducation'] == 'on'
            || $sdohData['moneyother'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Material Hardship") . "</span></td></tr>";
            }

            if ($sdohData['moneyfood'] == 'on'
            || $sdohData['transportfood'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Food Insecurity") . "</span></td></tr>";
            }

            if ($sdohData['housing'] == 'housetemporary'
            || $sdohData['housing'] == 'houseunsafe'
            || $sdohData['housing'] == 'housecar'
            || $sdohData['housing'] == 'houseunshelter'
            || $sdohData['housing'] == 'houseother'
            || $sdohData['debtrent'] == 'on'
            || $sdohData['moneyrent'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Housing Instability") . "</span></td></tr>";
            }

            if ($sdohData['transportmedical'] == 'on'
            || $sdohData['transportfood'] == 'on'
            || $sdohData['transportwork'] == 'on'
            || $sdohData['transportschool'] == 'on'
            || $sdohData['transportfamily'] == 'on'
            || $sdohData['transportother'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Transportation Insecurity") . "</span></td></tr>";
            }

            if ($sdohData['moneymedical'] == 'on'
            || $sdohData['medicalnoinsurance'] == 'on'
            || $sdohData['medicalcopay'] == 'on'
            || $sdohData['medicalnotcovered'] == 'on'
            || $sdohData['debtmedical'] == 'on'
            || $sdohData['dentist'] == 'dentistnoinsurance'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Medical Cost Burden") . "</span></td></tr>";
            }

            if ($sdohData['education'] == 'lessthanhs'
            || $sdohData['education'] == 'highschool'
            || $sdohData['medicalunderstand'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Low Health Literacy") . "</span></td></tr>";
            }

            if ($sdohData['careunder5'] == 'on'
            || $sdohData['care5to12'] == 'on'
            || $sdohData['careover12'] == 'on'
            || $sdohData['moneychildcare'] == 'on'
            || $sdohData['transportschool'] == 'on'
            || $sdohData['medicalchildcare'] == 'on'
            || $sdohData['caredisabled'] == 'on'
            || $sdohData['careelderly'] == 'on'
            || $sdohData['careother'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Caregiver Burden") . "</span></td></tr>";
            }

            if ($sdohData['social'] == 'sociallessthan1'
            || $sdohData['social'] == 'social1'
            || $sdohData['social'] == 'social2to3'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Social Isolation") . "</span></td></tr>";
            }

            if ($sdohData['stress'] == 'stresslevelsomewhat'
            || $sdohData['stress'] == 'stresslevelalot'
            || $sdohData['stress'] == 'stresslevelverymuch'
            || $sdohData['stressdeath'] == 'on'
            || $sdohData['stressdivorce'] == 'on'
            || $sdohData['stressjob'] == 'on'
            || $sdohData['stressmoved'] == 'on'
            || $sdohData['stressillness'] == 'on'
            || $sdohData['stressvictim'] == 'on'
            || $sdohData['stresswitness'] == 'on'
            || $sdohData['stresslegal'] == 'on'
            || $sdohData['stresshomeless'] == 'on'
            || $sdohData['stressincarcerated'] == 'on'
            || $sdohData['stressbankruptcy'] == 'on'
            || $sdohData['stressmarriage'] == 'on'
            || $sdohData['stressbirth'] == 'on'
            || $sdohData['stressadultchild'] == 'on'
            || $sdohData['stressother'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Elevated or Toxic Stress") . "</span></td></tr>";
            }

            if ($sdohData['partnersafety'] == 'partnerunsafe'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Intimate Partner Violence") . "</span></td></tr>";
            }

            if ($sdohData['safety'] == 'safeday'
            || $sdohData['safety'] == 'safeno'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Unsafe Neighborhood") . "</span></td></tr>";
            }

            if ($sdohData['discrimrace'] == 'on'
            || $sdohData['discrimgender'] == 'on'
            || $sdohData['discrimsexpref'] == 'on'
            || $sdohData['discrimgenexp'] == 'on'
            || $sdohData['discrimreligion'] == 'on'
            || $sdohData['discrimdisability'] == 'on'
            || $sdohData['discrimage'] == 'on'
            || $sdohData['discrimweight'] == 'on'
            || $sdohData['discrimses'] == 'on'
            || $sdohData['discrimedu'] == 'on'
            || $sdohData['discrimmarital'] == 'on'
            || $sdohData['discrimcitizen'] == 'on'
            || $sdohData['discrimaccent'] == 'on'
            || $sdohData['discrimcriminalhist'] == 'on'
            || $sdohData['discrimother'] == 'on'
            || $sdohData['displacework'] == 'on'
            || $sdohData['displacehousing'] == 'on'
            || $sdohData['displacehealth'] == 'on'
            || $sdohData['displacelaw'] == 'on'
            || $sdohData['displaceedu'] == 'on'
            || $sdohData['displacepublic'] == 'on'
            || $sdohData['displaceclubs'] == 'on'
            || $sdohData['displacegovt'] == 'on'
            || $sdohData['displacefinance'] == 'on'
            || $sdohData['displaceother'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Discrimination") . "</span></td></tr>";
            }

            if ( $sdohData['medicalnoinsurance'] == 'on'
            || $sdohData['dentist'] == 'dentistnoinsurance'
            || $sdohData['medicalcopay'] == 'on'
            || $sdohData['medicalnotcovered'] == 'on'
            )
            {
                echo "<tr></tr><td><span class=text>" . xlt("Uninsured or Underinsured") . "</span></td></tr>";
            }


        }


    }

    print "</tr></table>";
}
