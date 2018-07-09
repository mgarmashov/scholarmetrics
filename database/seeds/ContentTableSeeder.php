<?php

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutContent = '<p>Tracking scholarly performance is challenging, especially given the continuous stream of new publications and resulting citation activity. Over the past three years, I have been collecting data about urban planning scholarship, most recently posting rankings of ACSP member schools on my blog at <a target="_blank" rel="nofollow" href="http://tomwsanchez.com/">tomwsanchez.com</a>, which includes faculty rankings for&nbsp;<a target="_blank" rel="nofollow" href="http://tomwsanchez.com/faculty-scholarly-productivity-and-reputation-in-planning-a-preliminary-citation-analysis/">2013</a>,&nbsp;<a target="_blank" rel="nofollow" href="http://tomwsanchez.com/2014-urban-planning-citation-analysis/">2014</a>, and <a target="_blank" rel="nofollow" href="http://tomwsanchez.com/2015-urban-planning-citation-analysis/">2015</a>. During this time, I have also been working on a tool to make these data accessible to faculty and their departments. Although the website is in its early stages, I am looking to get feedback on data accuracy (e.g., faculty rosters) and ideas for additional analyses/metrics.  In the works are more complete profile information for individual faculty and departments, peer comparisons based on research areas and faculty rank, and network analyses of co-authorship.
            </p>
            <p>See also:</p>
            <ul>
                <li><a target="_blank" rel="nofollow" href="http://jpe.sagepub.com/content/early/2016/03/16/0739456X16633500.abstract">Sanchez, Thomas W. 2016. Faculty Performance Evaluation using Citation Analysis: An Update, Journal of Planning Education and Research, (forthcoming). DOI: 10.1177/0739456X16633500.</a></li>
                <li><a target="_blank" rel="nofollow" href="http://wuj.cgpublisher.com/product/pub.173/prod.376">Sanchez, Thomas W. 2014. Academic Visibility and the Webometric Future, The Journal of the World Universities Forum, 6(2): 37-52.</a></li>
            </ul>
            <p>For more references visit the <a target="_blank" rel="nofollow" href="https://www.mendeley.com/groups/1318573/citation-analysis-bibliometrics-and-webometrics/">“Citation Analysis, Bibliometrics, and Webometrics”</a>&nbsp;Mendeley Group.</p>';
        factory(Content::class)->create([
            'type' => 'about',
            'value' => $aboutContent
        ]);

        factory(Content::class)->create([
            'type' => 'year',
            'value' => '2018'
        ]);
    }
}
