/**
 * A small set of extensions for easier work with data sampling,
 * or their systematization
 *
 * @author Mirele
 * @package Mirele
 * @version 1.0.0
 */

Math.randomInt = function(min = 0, max = 1, round = true) {
    if (round) {
        return Math.round(min - 0.5 + Math.random() * (max - min + 1));
    } else {
        return min - 0.5 + Math.random() * (max - min + 1);
    }
}

Array.prototype.random = function() {
    return this[Math.floor(Math.random() * this.length)]
}

Object.defineProperty(Object.prototype, 'random', {
    value: function() {
        return this[Object.keys(this).random()];
    },
    enumerable: false
});

function sleep(ms) {
    ms += new Date().getTime();
    while (new Date() < ms) {}
}

function lorem(count = 6) {
    let lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos expedita dolorem perspiciatis soluta tempora, sit porro dolor optio fugit. Soluta, dolores quas voluptatem dolorem sed adipisci a obcaecati distinctio odio quisquam ullam aspernatur, modi, nulla harum dicta. Accusamus nihil vel esse culpa maiores. Voluptatem natus reprehenderit vitae distinctio pariatur quia, obcaecati corrupti quisquam, at eveniet doloremque deleniti consequatur, ratione cumque voluptas. Nesciunt explicabo obcaecati reprehenderit molestiae veniam quidem sit numquam corporis. Accusantium nesciunt corporis ipsum magni harum aliquam beatae voluptatum sit exercitationem repellendus asperiores, ad nisi. Non excepturi nulla voluptatibus veritatis dignissimos doloribus possimus quasi unde minima perferendis. Dolorem, consectetur quia. Temporibus eius maxime omnis accusamus nihil, mollitia aut commodi quasi error explicabo, tenetur, quos consequatur magnam quod ullam eos fuga repellat nisi eum voluptate! Ut, culpa! Odit a porro amet animi, iste quibusdam dicta quo in, optio inventore error exercitationem fuga. Labore a deleniti id quod quo reiciendis cupiditate provident, accusamus repellat necessitatibus porro. Aliquam quo, consectetur, libero eveniet necessitatibus corrupti voluptatibus possimus laborum dicta perferendis, accusantium rem eum ad. Quos expedita rem dolore officia possimus quod illo, ex perspiciatis saepe, recusandae reiciendis dicta impedit cum odio perferendis temporibus culpa neque quidem alias molestiae? Accusantium, repellat? Voluptas animi iusto eligendi suscipit quasi, id voluptatem inventore impedit sunt odio error natus debitis, voluptate aliquam, rerum at. Excepturi, tenetur qui. Suscipit recusandae id eveniet libero iure unde sit nisi expedita, explicabo molestiae assumenda maiores amet quas repellendus, atque labore? Modi corporis amet atque facere asperiores saepe unde minus reprehenderit dolore id esse, quam ut possimus rem autem nisi aliquam non dicta ad sint doloribus dolorum ducimus veniam necessitatibus? Cumque autem tenetur aperiam nesciunt aspernatur laborum? Exercitationem cum nam eos, corporis quisquam iste quasi facilis soluta dolore voluptate debitis odit rerum voluptatibus quo consectetur eveniet officiis blanditiis similique quaerat nulla dolorum. Tenetur harum dicta, libero rerum nobis, doloremque, odio laudantium itaque ex iusto deleniti consequuntur? Autem nemo numquam fugiat tempora tempore doloremque voluptatum, dolores itaque est maiores architecto incidunt eius quasi corporis obcaecati perspiciatis rerum quam labore voluptates voluptas ipsam atque sint fuga? Dicta et deserunt, quis provident in maxime fugiat sequi eveniet! Quae eveniet odit voluptatem vero laborum, dicta nihil mollitia in veritatis distinctio ipsam consequuntur aperiam reprehenderit debitis. Ullam vel incidunt delectus debitis harum veritatis illum quos, numquam, pariatur, consectetur vero. Aut, nihil quibusdam eveniet laudantium quasi qui, recusandae dolor incidunt ipsam quisquam voluptatibus culpa sint minima nobis nam aliquid assumenda est debitis provident sunt dolores aliquam. Expedita incidunt, quas sit ea quam quasi inventore laborum voluptatibus! Cupiditate, neque porro animi consequatur accusantium amet nam magnam doloremque repellat fugit impedit possimus repellendus temporibus error aliquid eius sunt libero veniam. Placeat, ipsa. Repellat, quae. Explicabo unde facilis accusamus! A, omnis sapiente nostrum recusandae, impedit porro consequuntur reprehenderit distinctio animi sunt accusantium sit, sed nesciunt repellendus minus rem error. Suscipit velit quas sint amet magnam aut totam perferendis nisi, sapiente maxime corporis ad saepe cupiditate soluta optio pariatur. Alias iure, soluta ratione voluptatibus eveniet blanditiis reprehenderit, odit ducimus est repellendus natus vel, ipsa consequuntur debitis enim et! Nesciunt pariatur optio doloremque repellendus facilis voluptas alias? Magnam tempora nihil adipisci totam saepe, eaque repellendus et, quo autem quibusdam culpa exercitationem, unde expedita dignissimos dolore temporibus. Earum, omnis. Sed sequi sunt accusantium et molestiae atque cupiditate earum. Perferendis molestiae a, consectetur eius dolorum, excepturi delectus illo rem cum explicabo magnam officiis velit, at animi debitis omnis totam obcaecati. Consequuntur, enim et? Cum rem corrupti veniam commodi omnis aut molestias dolores assumenda hic at, adipisci impedit iste quod error similique laudantium sed. Consequatur, aliquid totam quo facere at eum, blanditiis recusandae mollitia aperiam dolor suscipit corporis ratione laudantium magni est cumque alias rerum? Molestias, consequuntur dicta fuga tempora tempore earum reiciendis porro, ea non ipsam aperiam consequatur blanditiis adipisci placeat accusamus quod a beatae architecto eius? Cupiditate laudantium harum labore nostrum provident ullam, sit iusto id rerum libero dolore sapiente distinctio ipsam? Veniam, dolor necessitatibus id eaque quaerat, quasi ipsam quidem voluptates minima modi tenetur fuga. Nam odio quam quos ipsa nobis ratione dolores aliquam, sint soluta voluptate! Libero voluptate aliquam architecto explicabo deleniti amet eveniet? Enim neque saepe, obcaecati hic totam, aperiam exercitationem vitae aut tenetur magni veniam ipsa, unde corrupti nemo quibusdam? Similique ipsam obcaecati magni exercitationem error, minus illo, itaque eligendi sequi recusandae dolorem sit ratione alias quam maxime, tempore laboriosam? Fugit inventore in eligendi nostrum porro a, nihil iure harum illum doloremque perferendis saepe voluptatibus explicabo quibusdam totam libero soluta officiis enim, est, sapiente quo. Nisi quaerat consequuntur repellendus dolorem assumenda rerum reiciendis labore facere tenetur eligendi! Voluptate sequi quas debitis facilis labore? Voluptates cupiditate asperiores et exercitationem consequatur, voluptas nemo dignissimos maiores, officia quae quidem aut! Voluptatum, quia incidunt maxime, perspiciatis assumenda culpa veniam itaque voluptates iusto dolores adipisci nostrum, et quasi? Nihil eveniet, provident necessitatibus temporibus quos vitae libero. Quos culpa omnis odio qui alias? Dolorem ab optio perspiciatis exercitationem, consectetur odit, fuga veniam ea quam aut libero sequi aliquam totam sunt quos? Nisi iste modi laboriosam perferendis quas repudiandae magni praesentium ipsam suscipit. Ab obcaecati deleniti excepturi at nobis, blanditiis ipsum sapiente, officia atque dolorum dolore quas? Amet dolorum aperiam maiores ducimus, tempora exercitationem voluptatibus vel adipisci a, tenetur distinctio. Quis nam animi placeat suscipit illo consequuntur nobis dolorem eveniet obcaecati harum repellat rerum veritatis, fuga amet beatae numquam facere tempora enim. Deleniti quibusdam tenetur accusamus expedita dolore cumque? Saepe minima voluptatem maxime consequatur commodi debitis maiores, voluptates distinctio porro accusantium. Odio nam eligendi dolor consequatur ea optio rerum aliquam sequi impedit eaque sapiente quas velit incidunt distinctio quisquam corporis repudiandae, id, odit corrupti non laudantium ab officiis debitis libero! Nam quidem nesciunt accusamus sed! Eligendi modi iusto fugit distinctio vitae ea dignissimos odio architecto iure quod unde similique omnis nulla, facilis libero quasi voluptate tempora autem maiores, reiciendis laudantium! Quo officia esse adipisci reiciendis sed accusamus harum hic ipsa sunt provident sapiente quae similique in ut voluptas, ducimus velit doloribus praesentium quia possimus dolorum reprehenderit porro. Veritatis possimus nulla repellat laudantium numquam, ipsam enim debitis aspernatur quia. Voluptate recusandae nam voluptatibus ratione dolor vitae quisquam inventore. Debitis possimus adipisci facere exercitationem porro nobis maiores autem sit, quisquam beatae. Similique, et minus?'.split(' ');
    return lorem.slice(0, count).join(' ');
}

class Integer {
    random(min, max) {
        return Math.floor(min + Math.random() * (max + 1 - min));
    }
}

function hashCode (str){
    var hash = 0;
    if (str.length == 0) return hash;
    for (i = 0; i < str.length; i++) {
        char = str.charCodeAt(i);
        hash = ((hash<<5)-hash)+char;
        hash = hash & hash; // Convert to 32bit integer
    }
    return hash;
}

/**
 * Function to register execution
 * other functions in asynchronous order
 *
 * @version 1.0.0
 * @param {function} callback
 */

function async_execute(callback) {
    setTimeout(function() {
        if (callback) { callback(); }
    }, 0);
}
