let gigsContainer = document.querySelector('.current-gigs-inner');

async function loadGigs() {
  const index = await fetch('./scan.php').then(r => r.json());

  if (index.length === 0) {
    gigsContainer.innerHTML = ('Nie ma obecnie dodanych żadnych koncertów');
    return;
  }

  const gigs = await Promise.all(
    index.map(gig => fetch(`./gigs/${gig}`).then(r => r.json()))
  );

  console.log(gigs);

  let gigsHTMLParsed = gigs
    .map(gig => `
    <div class="gig-card p-3 border rounded relative">
      <div class="gig-card-control absolute right-3 top-3">
        <a href="./delete.php?title=${gig.Title}" class="bg-punkRed hover:bg-punkRedHover px-3 py-1 text-white">Usuń</a>
      </div>
      <div class="gig-card-content">
        <div class="gig-card-item-header text-2xl">${gig.Title}</div>
        <div class="gig-card-item">Data: ${gig.Date}</div>
        <div class="gig-card-item">Miejsce wydarzenia: ${gig.Place}</div>
        <div class="gig-card-item">Miasto: ${gig.Location}</div>
        <div class="gig-card-item">Opis: ${gig.Description}</div>
        <div class="gig-card-item">Cena: ${gig.Tickets}</div>
        <div class="gig-card-item">Link: ${gig.Link}</div>
      </div>
    </div>
  `).join("");

  gigsContainer.innerHTML = gigsHTMLParsed;
}

loadGigs();
