let gigsContainer = document.querySelector('#gigs-container');

async function loadGigs() {
  const index = await fetch('./gigs/index.json').then(r => r.json());

  console.log(index);

  if (index.length === 0) {
    gigsContainer.className = "";
    gigsContainer.innerHTML = (`
      <div class="p-8 shadow-brutal border-white border-2">
        <p>Aktualnie pracujemy nad nowym materiałem. Albo leżymy dupą do góry. Ewentualnie pijemy. W każdym razie w
          najbliższym czasie nie przewidujemy żadnych koncertów.</br>
          <span class="font-black text-4xl font-punk block mt-2">STAY TUNED</span>
        </p>

      </div>
    `);
    return;
  } else {
    gigsContainer.className = "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8";
  }

  const gigs = await Promise.all(
    index.map(gig => fetch(`./gigs/${gig}.json`).then(r => r.json()))
  );

  console.log(gigs);

  let gigsHTMLParsed = gigs
    .map(gig => `
      <div class="gig-card bg-cardBg border-1 border-white p-6 flex flex-col justify-between transition-all duration-300 hover:border-punkRed shadow-brutal hover:shadow-brutalWhite group">
        <div>
          <!-- Data i Miejsce -->
          <div class="flex justify-between items-start mb-4 border-b border-gray-800 pb-3">
            <div class="font-punk text-3xl text-punkRed group-hover:text-white transition-colors">
              ${gig.Date}
            </div>
            <div class="text-right">
              <span class="block font-punk text-lg text-white uppercase">${gig.Place}</span>
              <span class="text-xs text-gray-400 uppercase tracking-widest font-mono">${gig.Location}</span>
            </div>
          </div>
          <!-- Nazwa Eventu -->
          <h3 class="font-punk text-2xl uppercase text-white mb-2 group-hover:text-punkRed transition-colors">
            ${gig.Title}
          </h3>
          <!-- Krótki opis -->
          <p class="text-gray-400 text-sm leading-relaxed mb-6">
            ${gig.Description}
          </p>
        </div>
        <!-- Dolny przycisk / status -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-800 mt-auto">
          <span class="text-xs text-gray-500 uppercase font-mono">${gig.Tickets}</span>
          <a href="${gig.Link}"
            class="bg-punkRed hover:bg-white text-white hover:text-darkBg font-punk uppercase text-xs py-2 px-4 transition-all tracking-wider">
            Więcej informacji
          </a>
        </div>
      </div>
    `);

  gigsContainer.innerHTML = gigsHTMLParsed;
}

loadGigs();
