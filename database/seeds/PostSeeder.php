<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Models\Post::create([
            'title'=>'Egypt, Bahrain probe coop. in military, civil manufacturing',
            'slug'=>Str::slug('Egypt, Bahrain probe coop. in military, civil manufacturing'),
            'body'=>"CAIRO – 9 November 2020: Egypt’s Minister of State for Military Production Mohamed Ahmed Morsi, discussed with Bahraini Ambassador to Egypt Hisham bin Muhammad al Jowder and permanent delegate to the Arab League cooperation in joint manufacturing.
            During a meeting, Monday at the premises of the Military Production Ministry, Morsi asserted the importance of enhancing cooperation between the military productions firms and the Bahraini ones in various military and civil manufacturing domains.
            He, also, underscored the significance of upholding the strategic partnership to benefit both sides, in light of their time-honored ties.
            The ministry will make use of all its human, technological and manufacturing capabilities in carrying out mega industrial projects with the Bahraini side, the minister of state said.
            He, meanwhile, invited a Bahraini delegation to pay a visit to firms and units of the Military Production Ministry to get first hand information about their potentials.
            Ambassador Jowder, for his part, hailed the role of the Military Production Ministry in developing state's military and civil industries, asserting the keenness of his country on opening further vistas of cooperation with the ministry.

            Egypt, Bahrain probe coop. in military, civil manufacturing

            CAIRO – 9 November 2020: Egypt’s Minister of State for Military Production Mohamed Ahmed Morsi, discussed with Bahraini Ambassador to Egypt Hisham bin Muhammad al Jowder and permanent delegate to the Arab League cooperation in joint manufacturing.
            During a meeting, Monday at the premises of the Military Production Ministry, Morsi asserted the importance of enhancing cooperation between the military productions firms and the Bahraini ones in various military and civil manufacturing domains.
            He, also, underscored the significance of upholding the strategic partnership to benefit both sides, in light of their time-honored ties.
            The ministry will make use of all its human, technological and manufacturing capabilities in carrying out mega industrial projects with the Bahraini side, the minister of state said.
            He, meanwhile, invited a Bahraini delegation to pay a visit to firms and units of the Military Production Ministry to get first hand information about their potentials.
            Ambassador Jowder, for his part, hailed the role of the Military Production Ministry in developing state's military and civil industries, asserting the keenness of his country on opening further vistas of cooperation with the ministry.",
            'image' =>'1.jpg',
            'user_id'=>1,
            'category_id'=>1
          ]);
          \App\Http\Models\Post::create([
            'title'=>'Sisi directs government to maximize use of state-owned assets in all fields',
            'slug'=>Str::slug('Sisi directs government to maximize use of state-owned assets in all fields'),//use with slug
            'body'=>"CAIRO - 9 November 2020: President Abdel Fattah El Sisi directed the government to maximize the use of the state-owned assets in all fields, according to a statement from the Cabinet on Monday.

            This direction was declared in a cabinet meeting chaired by Prime Minister Mustafa Madbouli with Minister of Agriculture and Land Reclamation Mr. Al-Qusayr and Deputy Minister for Livestock, Fisheries and Pourtly Affairs Mustafa Al-Sayyad to follow up on a fishery project.

            The Minister of Agriculture updated Madbouli on a project aimed to utilize untapped areas and water resources in fish farming via technology to achieve the highest rates of production and disseminate awareness of the importance of fishery production for Egypt and the Arab world, the statement added.

            The Minister continued that the project was offered for the private sector for investment.

            In November 2017, President Sisi inaugurated a number of major projects in Kafr al-Sheikh, 89 miles from Cairo, with a total cost of LE 4 billion ($226,659,972.64), topped by Middle East’s largest fish farm and its industrial city.

            The fish farming project consists of two phases, the first of which was carried out on an area of 4,000 acres and will expectedly cover up to 70 percent of Egypt’s domestic need of fish.

            The industrial city of the fish project includes four main factories, development and training center, and a central laboratory to ensure the high quality of the products.

            The area on which the excavation and drilling works take place amounted to 16 million Square meters, which is six times the size of the Great Pyramid; meanwhile, the iron rods required for the construction works were estimated at 13 thousand tons.",
            'image'=>'2.jpg',
            'user_id'=>2,
            'category_id'=>1
          ]);



          \App\Http\Models\Post::create([
            'title'=>"Egypt's Sisi to Macron: Differentiation between Islam and terrorist acts committed in the name of religion is a must",
            'slug'=>Str::slug("Egypt's Sisi to Macron: Differentiation between Islam and terrorist acts committed in the name of religion is a must"),
            'body'=>"CAIRO- 2 November 2020- In a phone call with French President Emmanuel Macron on Monday, President Abdel Fattah El Sisi affirmed that there should be a vivid differentiation between Islam and terrorist acts that are being committed in the name of the religion, said Presidential spokesperson Bassam Radi in a statement on Monday.

            “President stressed the necessity to completely differentiate between the Islamic religion, which calls for peace, tolerance and the renunciation of violence, and between terrorist actions committed by those who claim that they belong t Islam,” said President Sisi, adding “[Islam] has no relation with such acts in all forms. The perpetrators shall not justify their [terrorist] acts in the name of any divine religion.”

            President Sisi highlighted the necessity of disseminating the values of coexistence and tolerance among the various religions through dialogue, understanding, mutual respect, and not harming the religious figures and symbols, Radi said.

            “Egypt continues playing its role in this context, in a way that prevents terrorist groups and the countries that support them from achieving their goals, from distorting the image of Islam, and trading in its name to fuel Muslims’ anger,” President Sisi said.

            The phone call also tackled a number of bilateral ties and issues of mutual concern, particularly the Libyan turmoil, Radi said.

            French President Emmanuel Macron had said France would not renounce cartoons after a French teacher was killed for showing pupils cartoons distorting the image of Prophet Muhammad.

             Macron’s remarks have triggered Muslim nations’ anger. Also, campaigns to boycott French products have been circulated and encouraged on social media.

            During a speech to mark Prophet Muhammad's birthday celebrated every year by some Muslims in the Hijri month of Rabi’ Al-Awwal on October 30, 2020, Sisi denounced insulting prophets and messengers under the pretext of 'freedom of expression', demanding stopping all acts that hurt the feelings of a million and a half Muslims all over the world, and not to blame them for others actions.

            He said that “we [as Muslims] consider offending prophets and messengers is undermining high religious values that many people believe in. If you don’t believe then, this is your business, but hurting the feelings of Millions?!”

            In his speech at the celebration, Al-Azhar Grand Imam Sheikh Ahmed Al-Tayeb said that If Prophet Muhammad [Peace and Blessing be upon him] were not sent, all humanity would have remained in full darkness.”

            In light of this regard, President Sisi received a video call from German Chancellor Angela Merkel on Monday, discussing the possible ways of countering terrorism and extremist ideology, announced Egyptian presidency spokesperson Bassam Radi in a statement.

            The German Chancellor expressed the European Union’s support to cooperate with Egypt’s ancient religious institutions as a beacon of moderate Islam in the world, Radi said.

            He noted that Merkel praised President’s Sisi’s effective, objective and wise efforts in protecting religious freedoms and promoting peaceful coexistence between religions and civilizations.",
            'image'=>'3.jpg',
            'user_id'=>4,
            'category_id'=>2
          ]);

          \App\Http\Models\Post::create([
            'title'=>'In video call with Sisi, German Chancellor voices EU support for Egypt’s moderate religious institutions',
            'slug'=>Str::slug('In video call with Sisi, German Chancellor voices EU support for Egypt’s moderate religious institutions'),
            'body'=>"CAIRO - 2 November 2020: Egyptian President Abdel Fattah El-Sisi received a video call from German Chancellor Angela Merkel on Monday, discussing the possible ways of countering terrorism and extremist ideology, announced Egyptian presidency spokesperson Bassam Radi in a statement.

            The call made in light of the recent outrage of Muslims regarding anti-Islam remarks in some European countries, including France, Radi added.

            The German Chancellor expressed the European Union’s support to cooperate with Egypt’s ancient religious institutions as a beacon of moderate Islam in the world, Radi said.

            He noted that Merkel praised President’s Sisi’s effective, objective and wise efforts in protecting religious freedoms and promoting peaceful coexistence between religions and civilizations.

            During a speech to mark Prophet Muhammad's birthday celebrated every year by some Muslims in the Hijri month of Rabi’ Al-Awwal on October 30, 2020, Sisi denounced insulting prophets and messengers under the pretext of 'freedom of expression', demanding stopping all acts that hurt the feelings of a million and a half Muslims all over the world, and not to blame them for others actions.

            He said that “we [as Muslims] consider offending prophets and messengers is undermining high religious values that many people believe in. If you don’t believe then, this is your business, but hurting the feelings of Millions?!”

            Sisi’s remarks come while French President Emmanuel Macron had said France would not renounce cartoons after a French teacher was killed for showing pupils cartoons distorting the image of Prophet Muhammad.

             Macron’s remarks have triggered Muslim nations’ anger. Also, campaigns to boycott French products have been circulated and encouraged on social media.

            In his speech at the celebration, Al-Azhar Grand Imam Sheikh Ahmed Al-Tayeb said that If Prophet Muhammad [Peace and Blessing be upon him] were not sent, all humanity would have remained in full darkness.”

            ",
            'image'=>'4.jpg',
            'user_id'=>6,
            'category_id'=>2
          ]);
          \App\Http\Models\Post::create([
            'title'=>'Bayern stay strong to complete quadruple with Super Cup win',
            'slug'=>Str::slug('Bayern stay strong to complete quadruple with Super Cup win'),
            'body'=>"BUDAPEST (Reuters) - Bayern Munich beat Sevilla 2-1 after extra time on Thursday to lift the UEFA Super Cup and complete a quadruple under coach Hansi Flick, in the first European game played with fans in the stands since the sport returned amid the COVID-19 pandemic.
            Substitute Javi Martinez, in possibly his last game for Bayern, headed the winner in the 104th minute after Europa League winners Sevilla had taken a 13th-minute lead through Lucas Ocampos’s penalty and Bayern levelled through Leon Goretzka in the 34th.
            The Bavarians, unbeaten now in 32 consecutive matches, also won the domestic league and Cup double as well as the Champions League after Flick took over last November. Their last defeat dates back to December, 2019.
            “It was an intense game but we deserved to win,” Flick told reporters. “We are not yet fully in our rhythm despite our big win (8-0) over Schalke 04 on the weekend.
            “But the mentality of the team, especially after going 1-0 down, was sensational. They battled back against very strong opponents and deserved the win.”

            Bayern were the better side throughout and missed a bagful of chances through Robert Lewandowski, Benjamin Pavard and Thomas Mueller in the first half,
            Yet it was Bayern keeper Neuer who kept them in the game first with a one-on-one save against Youssef En-Nesyri to send the game to extra time and then pushing another shot from the Sevilla player onto the post two minutes into extra time.
            The Spaniards gradually ran out of steam, however, and it was only a matter of time until Bayern scored again.
            Martinez, who is reportedly close to agreeing to a return to Athletic Bilbao this season, benefited from being given too much space to head in on the rebound.

            The Spaniard also scored in extra time in Bayern’s only previous Super Cup win in 2013.
            Some 15,000 fans were seated in Budapest’s Puskas Arena with the game seen as a test event for the gradual return of fans to European games.
            “We all know it is not easy to take right decision,” Flick said of allowing fans. “But it felt good to have an atmosphere in the stadium. It felt a bit more like football. I hope all the fans return home healthy.”
            The match was held amid a growing second wave of COVID-19, with Hungarian cases at record highs, which had prompted warnings of the possible consequences of mass gatherings such as this game.",
            'image'=>'5.jpg',
            'user_id'=>9,
            'category_id'=>3
          ]);

          \App\Http\Models\Post::create([
            'title'=>'Presentation promises a thrilling Super Cup game',
            'slug'=>Str::slug('Presentation promises a thrilling Super Cup game'),
            'body'=>"CAIRO – 12 January 2020: The officials of Presentation Sport headed by Montaser El Nabarawi, promises the Egyptian football fans to present the expected Super Cup game between Al Ahly and Zamalek, set to be held in the United Arab Emirates on February 20, in a unique and unforgettable way that matches the prestigious presentation witnessed during Africa Cup of Nations and Africa Cup U23, both tournaments were organized in Cairo. ",
            'image'=>'6.jpg',
            'user_id'=>10,
            'category_id'=>3
          ]);


          \App\Http\Models\Post::create([
            'title'=>"Egypt’s Culture Palaces announces annual competition for children's arts 'Story & Painting'",
            'slug'=>Str::slug("Egypt’s Culture Palaces announces annual competition for children's arts 'Story & Painting'"),
            'body'=>"CAIRO – 1 November 2020: The General Authority for Cultural Palaces is holding the 5th annual competition for children's arts 'Story and Painting' for the year 2020, which is organized by the Fine Art Bus.

            The terms of the competition include that the number of written and drawn pages together should not exceed six pages, provided that the writing and drawing are on one side of an A4 paper and the story must be typed on a computer with a copy  attached to a C D.

            The age of the contestant must not exceed 16 years and at least 8 years old. The cover page of the story must include a drawing that expresses the theme of the story with the inclusion of the contestant’s full name, phone number, governorate and entity they are representing.

            The story must be based on the imagination of the contestant and must not be copied or previously written anywhere else. The same conditions goes for the drawing.

            There is the possibility of presenting a joint work between two children, one writing the story and the other drawing it.

            Each submitted job shall be accompanied by a copy of the contestant's birth certificate and the deadline for receiving the works is November 20.
             ",
            'image'=>'7.jpg',
            'user_id'=>9,
            'category_id'=>4
          ]);
          \App\Http\Models\Post::create([
            'title'=>"Sinai, the Land of Heroism lecture held in Red Sea Culture Palace on Nov. 2",
            'slug'=>Str::slug("Sinai, the Land of Heroism lecture held in Red Sea Culture Palace on Nov. 2"),
            'body'=>"According to a statement issued by the General Authority for Culture Palaces, the Shalateen Culture Palace, affiliated to the Red Sea Culture Palace, organized a lecture entitled 'Sinai, the Land of Heroism,' given by the writer Khaled Awad.

            Awad explained that Sinai is an important geographical area, as it is considered the link between the continents of Asia and Africa, and there is religious significance to it as many of the prophets passed through it or resided on its land.

            It also has historical significance as it was the main crossing point for the Islamic armies to the African continent.

            The first of these armies was led by Amr bin Al-Aas.

            Also, a cultural competition entitled 'Competition and Prize' was held and moderated by Khaled Awad.
             ",
            'image'=>'8.jpg',
            'user_id'=>10,
            'category_id'=>4
          ]);



          \App\Http\Models\Post::create([
            'title'=>'Egypt’s recovery rates of COVID-19 hit 91.8%',
            'slug'=>Str::slug("Egypt’s recovery rates of COVID-19 hit 91.8%"),
            'body'=>"CAIRO – 9 November 2020: Ministry of Health announced that the recovery rates from Coronavirus pandemic at isolation hospitals hit 91.8 percent.

            A total of 103 patients left the hospitals after receiving necessary medical treatment, and the total number of recovered cases have reached 100, 342.

            The ministry has allocated the hotlines, 105and 15335, to receive citizens' inquiries about the coronavirus and infectious diseases. This is in addition to the WhatsApp number, 01553105105, and the Egypt Health application available on phones.

            Egypt ranks 49th among world countries in terms of recovery rates (93.2 percent), and ranks 141st in the world in terms of total infections per one million people, (1,016 infections per 1 million).

            For his part, Dr. Hossam Hosni, head of the Scientific Committee to Combat Corona, told Egypt Today that the Ministry of Health and Population has prepared a grand plan to confront influenza and Corona infection in the winter season, stressing that the schools’ plan to confront the Corona virus “guarantees full protection for all students.”

            Egypt is planning to apply clinical trials on 6,000 people, and in case 215 persons were infected with COVID-19, the codes of the vaccine will be dismantled and the research will be halted. Then, they will wait for one year along with the measurement of antibodies of the volunteers, and then manufacture the vaccine.
            ",
            'image'=>'10.jpg',
            'user_id'=>2,
            'category_id'=>5
            ]);

          \App\Http\Models\Post::create([
            'title'=>'Egypt reports 201 new COVID-19 cases, 11 deaths',
            'slug'=>Str::slug('Egypt reports 201 new COVID-19 cases, 11 deaths'),
            'body'=>"CAIRO - 6 November 2020: Egypt's Health Ministry said Wednesday it reported 201 new coronavirus cases, upping the total number of confirmed cases in Egypt since the beginning of the outbreak to 108,530.
            In a statement, Spokesman for the Health Ministry Khaled Megahed said 11 patients have died from the novel virus over the past 24 hours, raising the death toll to 6,329.
            As many as 132 patients were discharged from isolation hospitals after receiving necessary medical care, taking the number of recovered cases to 100,006 so far, the spokesman said.
            Egypt is participating in the international efforts to find a vaccine for coronavirus  along with another three Arab countries, UAE, Bahrain, and Jordan. The share of Egypt is planned to be 6,000 volunteers.
            Zayed pointed out that the volunteer will receive the vaccine in two times separated by 21 days, and he/she shall be under monitor for a year.
            The minister of health added that each the personal information and the medical history of each volunteer will be recorded, the volunteer will receive a full brief on the clinical trial after being tested to check if he/she meets the requirements of the clinical trial.
            Egyptian Cabinet’s Spokesperson Nader Saad revealed on Tuesday in several TV statements that the government is about to take a number of strict decisions in the context of its fight against the spread of Coronavirus pandemic.
            The decisions come as the infection rates recorded are increasing on a daily basis, which required a firm interference to protect citizens as a second wave has forced some European countries to lockdown again.
            Atop of the decisions expected to be announced Wednesday is a L.E. 4,000 fine against any citizen not wearing a mask in closed places.
            The decisions further include increasing the amount of flu vaccine available for public from 500,000 syringes to 2.5 million shots, in addition to closing any schools for 28 days if recorded infection cases.
            For cafés and restaurants, there will be inspection campaigns to ensure all precautionary measures are applied, while determining closure time for them that have one hour difference between summer and winter seasons.
            Restaurants will close its doors at 12 p.m. in winter, while extend by an hour during summer.
            All medicines and medical supplies should be provided in large quantities at hospitals and pharmacies.
            There will be more flexibility when dealing with shops and restaurants in tourist governorates regarding closing times.",
            'image'=>'11.jpg',
            'user_id'=>8,
            'category_id'=>5
            ]);






    }
}
