-- Garba26 Rich Seed Data
-- Users: Password is 'garba123' bcrypt hashed: $2y$10$wS2x5xTqLz9x4hI1qR8g3.y1jR3d6gU2tP5vL7mB9sC1eD3fG5hI6 (or standard verified hash)

INSERT OR IGNORE INTO users (id, name, email, password, role, bio) VALUES
(1, 'Admin Garba26', 'admin@garba26.com', '$2y$10$rC8vR/H/fX0z1hL3qE5a..M8C5yB0fW6P2wN1nB4mC6eD8gJ0hL2m', 'admin', 'Lead Curator & Sound Engineer at Garba26.'),
(2, 'Kinjal Patel', 'user@garba26.com', '$2y$10$rC8vR/H/fX0z1hL3qE5a..M8C5yB0fW6P2wN1nB4mC6eD8gJ0hL2m', 'user', 'Navratri enthusiast, 3-Taali performer & Garba lover from Ahmedabad.');

-- Artists
INSERT OR IGNORE INTO artists (id, name, slug, image, bio, genres, monthly_listeners, is_verified) VALUES
(1, 'Falguni Pathak', 'falguni-pathak', '/assets/images/default-avatar.png', 'The undisputed Dandiya Queen of India, bringing energetic rhythm and timeless festive classics across the globe.', 'Dandiya Raas, 2-Taali, Bollywood Garba', 1250000, 1),
(2, 'Atul Purohit', 'atul-purohit', '/assets/images/default-avatar.png', 'The Soul of United Way Baroda. Legendary pioneer of devotional Tran-Taali and heartfelt Ambe Maa aarti.', 'United Way, 3-Taali, Devotional', 980000, 1),
(3, 'Kinjal Dave', 'kinjal-dave', '/assets/images/default-avatar.png', 'Sensational Gujarati folk voice famous for Char Char Bangadi, modern stage performances, and high-energy folk.', 'Folk Pop, Sanedo, 2-Taali', 850000, 1),
(4, 'Kirtidan Gadhvi', 'kirtidan-gadhvi', '/assets/images/default-avatar.png', 'The roaring powerhouse of Dayro and Raas Garba. Renowned for unforgettable high-pitched classical improv.', 'Dayro, Dandiya Raas, Kathiyawadi', 920000, 1),
(5, 'Geeta Rabari', 'geeta-rabari', '/assets/images/default-avatar.png', 'The Nightingale of Kutch (Kutch Ni Koyal), known for soulful traditional ballads, Rona Ser Ma, and festive dhol beats.', 'Kutchi Folk, Dakla, Fusion', 780000, 1),
(6, 'Aditya Gadhvi', 'aditya-gadhvi', '/assets/images/default-avatar.png', 'Global sensation and voice of "Khalasi", redefining Gujarati folk on international stages with electrifying style.', 'Folk Fusion, Hech, Global Beats', 1100000, 1),
(7, 'Hemant Chauhan', 'hemant-chauhan', '/assets/images/default-avatar.png', 'Revered maestro of traditional Gujarati devotional songs, stutis, and evergreen Garba heritage.', 'Aradhiya, Stuti, Traditional', 650000, 1),
(8, 'Praful Dave', 'praful-dave', '/assets/images/default-avatar.png', 'Golden voice of Gujarati cinema and historic Garba melodies, ruling hearts for over four decades.', 'Classic 90s, Hech, Mandvi Garba', 550000, 1),
(9, 'Osman Mir', 'osman-mir', '/assets/images/default-avatar.png', 'Master of classical nuances, Mor Bani Thanghat Kare, and enchanting Raas rhythms.', 'Sufi Folk, Dandiya Raas, Classical', 620000, 1),
(10, 'Bhoomi Trivedi', 'bhoomi-trivedi', '/assets/images/default-avatar.png', 'Dynamic playback singer delivering powerful festival anthems like Ram Chahe Leela and Udi Udi Jaye.', 'Electro Garba, Modern Fusion', 710000, 1),
(11, 'Darshan Raval', 'darshan-raval', 'https://i.ytimg.com/vi/yr7JFNsz5dU/hqdefault.jpg', 'Heartthrob playback maestro redefining modern Garba and festive pop.', 'Modern Fusion, Pop, Garba', 1450000, 1),
(12, 'Sachin-Jigar', 'sachin-jigar', 'https://i.ytimg.com/vi/tTfF5klskmo/hqdefault.jpg', 'Iconic Gujarati composer duo combining authentic folk instruments with arena soundscapes.', 'Modern Fusion, Folk, Garba', 980000, 1),
(13, 'Rupal Doshi', 'rupal-doshi', 'https://i.ytimg.com/vi/lPO7G8wlCqQ/hqdefault.jpg', 'Soulful traditional Garba singer known for high-octane dhol and classic raas melodies.', '2-Taali, Dandiya, Folk', 620000, 1),
(14, 'Hema Desai', 'hema-desai', 'https://i.ytimg.com/vi/CJRGtgQBxno/hqdefault.jpg', 'Legendary Gujarati folk and devotional vocalist whose stutis grace temples across Gujarat.', 'Aradhiya, Stuti, Traditional', 540000, 1),
(15, 'Amit Trivedi & Osman Mir', 'amit-trivedi-osman-mir', 'https://i.ytimg.com/vi/Jv8KRwF1zQs/hqdefault.jpg', 'National award-winning composer Amit Trivedi collaborating with Osman Mir for breathtaking folk transcendence.', 'Modern Fusion, Sufi Folk, Garba', 850000, 1),
(16, 'Herry Nakum', 'herry-nakum', 'https://i.ytimg.com/vi/B4qSyd48zTs/hqdefault.jpg', 'Acclaimed folk artist known for authentic flute cadences and soulful traditional Saurashtra garba.', '2-Taali, Folk, Traditional', 420000, 1),
(17, 'Maheshsinh Solanki', 'maheshsinh-solanki', 'https://i.ytimg.com/vi/atKTqi9ID7A/hqdefault.jpg', 'Powerful devotional and folk vocalist celebrating the divine aura of Maa Ambe.', 'Aradhiya, Stuti, Folk', 380000, 1),
(18, 'Zeel Joshi', 'zeel-joshi', 'https://i.ytimg.com/vi/s-QIqX0sjSs/hqdefault.jpg', 'Vibrant festive singer delivering fast-paced 3-Taali beats and crowd-pleasing Navratri tracks.', '3-Taali, Dandiya Raas, Modern', 390000, 1);

-- Albums
INSERT OR IGNORE INTO albums (id, title, slug, artist_id, release_year, description) VALUES
(1, 'United Way Baroda Live 2026', 'united-way-baroda-live-2026', 2, 2026, 'The spiritual high of Navratri under the moonlit grounds of Baroda.'),
(2, 'Dandiya Night Supreme', 'dandiya-night-supreme', 1, 2025, 'Non-stop high beat dandiya mixes by the Dandiya Queen.'),
(3, 'Khalasi & The Heritage Waves', 'khalasi-heritage-waves', 6, 2024, 'Viral sounds, tribal rhythms, and cutting-edge acoustic folk.'),
(4, 'Char Char Bangadi Melodies', 'char-char-bangadi-melodies', 3, 2025, 'Vibrant upbeat songs celebrating youth, joy, and celebration.'),
(5, 'Kathiyawadi Dayro & Ramzat', 'kathiyawadi-dayro-ramzat', 4, 2026, 'Pure thumping dhol and authentic Gujarati dayro experience.'),
(6, 'Kutch Ni Dharti Suvarna Hits', 'kutch-ni-dharti-suvarna-hits', 5, 2025, 'Echoes of the desert sands and rustic soulful harmonies.'),
(7, 'Maa Ambe Aradhiya Sangrah', 'maa-ambe-aradhiya-sangrah', 7, 2023, 'Timeless aartis and stutis invoking divine blessings.'),
(8, 'Golden 90s Khelaiya Collection', 'golden-90s-khelaiya-collection', 8, 2024, 'Remastered nostalgic audio from the era that started modern garba.'),
(9, 'Rangilo Raas & Sanedo Live', 'rangilo-raas-sanedo-live', 9, 2025, 'Energetic calls, fast-paced dholak, and swirling skirts.'),
(10, 'Garba Euphoria 2026', 'garba-euphoria-2026', 10, 2026, 'Bass-heavy festival anthems crafted for massive arena sound systems.'),
(11, 'Loveyatri & Urban Garba Nights', 'loveyatri-urban-garba-nights', 11, 2026, 'Modern festival anthems that spark fireworks on every dancefloor.'),
(12, 'Aavjo Re Shamliya Live', 'aavjo-re-shamliya-live', 12, 2026, 'Contemporary Gujarati compositions blending rich tradition with dynamic orchestral energy.'),
(13, 'Dholida Express Nonstop', 'dholida-express-nonstop', 13, 2026, 'Uninterrupted traditional dhol rhythms and fast-paced claps.'),
(14, 'Bhakti Vandana & Garbe Ramva Aavo', 'bhakti-vandana-garbe-ramva-aavo', 14, 2026, 'Revered devotional offerings invoking Maa Ambe and Pavagadh Mahakali.'),
(15, 'Songs of Faith & Folk Transcendence', 'songs-of-faith-folk-transcendence', 15, 2026, 'Spiritual heights and festive celebration blended with modern orchestral folk.'),
(16, 'Mathura Ni Morli Rasotsav', 'mathura-ni-morli-rasotsav', 16, 2026, 'Melodious Krishna-Radha raas collection steeped in pure Gujarati countryside charm.'),
(17, 'Amba Tu Aavje Maa Aradhiya', 'amba-tu-aavje-maa-aradhiya', 17, 2026, 'Devotional garba hymns invoking blessing, health, and spiritual celebration.'),
(18, 'Garbe Ramva Jau Mare Live', 'garbe-ramva-jau-mare-live', 18, 2026, 'Electrifying continuous dandiya raas rhythms designed for high-energy ground dancing.');

-- Genres
INSERT OR IGNORE INTO genres (id, name, slug, description) VALUES
(1, '2-Taali (Be Taali)', '2-taali', 'The quintessential rhythmic double clap garba step, smooth and hypnotic.'),
(2, '3-Taali (Tran Taali)', '3-taali', 'High-tempo triple clap with swift spins and circular synchrony.'),
(3, 'Dandiya Raas', 'dandiya-raas', 'Enchanting rhythmic clacking of sticks in dual concentric wheels.'),
(4, 'Hech Style', 'hech', 'Distinctive swaying motion characterized by accelerated dhol cadences.'),
(5, 'Sanedo', 'sanedo', 'Witty folk couplets followed by explosive four-beat refrain.'),
(6, 'Dakla Trance', 'dakla', 'Fast-paced mystical percussion played on traditional hour-glass dak drums.'),
(7, 'Aradhiya & Stuti', 'aradhiya', 'Solemn devotional hymns sung before midnight celebrations.'),
(8, 'Modern Fusion', 'modern-fusion', 'Electronic synths, dholak drops, and modern basslines infused with folk.');

-- Songs
INSERT OR IGNORE INTO songs (id, title, slug, artist_id, album_id, genre_id, duration, audio_url, youtube_id, cover_image, style, era, tradition, lyrics, plays_count, is_featured, is_popular) VALUES
(1, 'Tara Vina Shyam Mane Eklatu Lage', 'tara-vina-shyam-mane-eklatu-lage', 2, 1, 2, 380, '', NULL, '/assets/images/default-album.png', '3-Taali', 'Traditional', 'United Way', 'તારા વિના શ્યામ મને એકલડું લાગે, રાસ રમવાને વહેલો આવજે રે...\nગોપીઓના મનમાં તારી યાદ સતાવે, વાંસળીના સૂર રેલાવજે રે.', 184500, 1, 1),
(2, 'Khalasi (Gotilo)', 'khalasi-gotilo', 6, 3, 8, 245, '', NULL, '/assets/images/default-album.png', 'Hech', 'Modern', 'Saurashtra', 'જો ગતિ છે મુક્તિની તે છે સહજ...\nખોવાયેલા મોતી જેવો ખલાસી, સાગરનો સાથી સૂર્ય નો પ્રવાસી.', 295000, 1, 1),
(3, 'Chogada Tara Rang Chhe', 'chogada-tara-rang-chhe', 11, 11, 8, 275, 'https://youtu.be/yr7JFNsz5dU', 'yr7JFNsz5dU', 'https://i.ytimg.com/vi/yr7JFNsz5dU/hqdefault.jpg', 'Raas', 'Modern', 'Ahmedabad', 'છોગાળા તારા રંગ છે, રંગીલો રંગ છે...\nહે આવે રે આવે તારી યાદ રે, ધબકે છે હૈયું આજ રે.', 890000, 1, 1),
(4, 'Sanedo Sanedo Lal Lal Sanedo', 'sanedo-sanedo-lal-lal-sanedo', 4, 5, 5, 310, '', NULL, '/assets/images/default-album.png', 'Sanedo', 'Vintage 90s', 'Saurashtra', 'સનેડો સનેડો લાલ લાલ સનેડો...\nરૂપાળી રાધા ને કાનુડો ગમ્યો, સનેડા ની રમઝટ જામી રે!', 210000, 1, 1),
(5, 'Pethalpur Ma Pavo Vagyo', 'pethalpur-ma-pavo-vagyo', 1, 2, 1, 260, '', NULL, '/assets/images/default-album.png', '2-Taali', 'Traditional', 'Ahmedabad', 'પેથલપુરમાં પાવો વાગ્યો ને સાંભળી ગોપીઓ દોડી રે...\nરમઝટ જામી આજ આંગણે, કાન કુંવર સંગ હોળી રે.', 165000, 1, 1),
(6, 'Mor Bani Thanghat Kare', 'mor-bani-thanghat-kare', 9, 9, 4, 212, 'https://youtu.be/xJsvTCMg0qA', 'xJsvTCMg0qA', 'https://i.ytimg.com/vi/xJsvTCMg0qA/hqdefault.jpg', 'Hech', 'Modern', 'Saurashtra', 'મન મોર બની થનગનાટ કરે...\nમેઘાડંબર ઘેરાયેલું, આભે વીજળી ચમકાર કરે.', 590000, 1, 1),
(7, 'Char Char Bangadi Vali Gaadi', 'char-char-bangadi-vali-gaadi', 3, 4, 8, 195, '', NULL, '/assets/images/default-album.png', '2-Taali', 'Modern', 'Ahmedabad', 'ચાર ચાર બંગડી વાળી ઓડી લઈ દઉં...\nભાઈ મારો લાડકો, ગરબે ઘૂમતો જાય!', 275000, 0, 1),
(8, 'Ambe Maa Ni Aarti (Jai Adhyashakti)', 'ambe-maa-ni-aarti-jai-adhyashakti', 7, 7, 7, 813, 'https://youtu.be/U_DTkSAakVQ', 'U_DTkSAakVQ', 'https://i.ytimg.com/vi/U_DTkSAakVQ/hqdefault.jpg', 'Aradhiya', 'Traditional', 'Maa Ambe Stuti', 'જય આદ્યાશક્તિ મા જય આદ્યાશક્તિ...\nઅખંડ બ્રહ્માંડ દીપાવ્યા, પડવે પ્રગટ્યા મા.', 780000, 1, 1),
(9, 'Dakla 6 (Rudra Trance)', 'dakla-6-rudra-trance', 5, 6, 6, 275, '', NULL, '/assets/images/default-album.png', 'Dakla', 'Modern', 'Kutch', 'ડમરૂ વાગે ડાકલા ગૂંજે, માવડી પધારે આંગણિયે...\nખમકારો કરતી મા અંબા, કષ્ટ નિવારે પળમાં રે.', 174000, 1, 1),
(10, 'Radhe Radhe Shyam Se Milade', 'radhe-radhe-shyam-se-milade', 2, 1, 2, 330, '', NULL, '/assets/images/default-album.png', '3-Taali', 'Traditional', 'United Way', 'રાધે રાધે શ્યામ સે મિલાદે...\nવૃંદાવન કી ગલીયો મેં, મુરલી કી મીઠી ધૂન સુનાદે.', 152000, 0, 1),
(11, 'Lili Lemdi Re Lili Lemdi', 'lili-lemdi-re-lili-lemdi', 8, 8, 1, 240, '', NULL, '/assets/images/default-album.png', '2-Taali', 'Vintage 90s', 'Saurashtra', 'લીલી લીમડી રે લીલી લીમડી પર મોરલો બોલે...\nકાનુડા ની મોરલી સાંભળી, રાધા નું હૈયું ડોલે.', 122000, 0, 0),
(12, 'Dholida Dhol Re Vagad', 'dholida-dhol-re-vagad', 13, 13, 3, 481, 'https://youtu.be/lPO7G8wlCqQ', 'lPO7G8wlCqQ', 'https://i.ytimg.com/vi/lPO7G8wlCqQ/hqdefault.jpg', 'Raas', 'Modern', 'Ahmedabad', 'ઢોલીડા ઢોલ રે વગાડ મારે હિંચ લેવી છે...\nઢોલ ના તાલે ઝૂમે આખી રાત રે!', 389000, 1, 1),
(13, 'Vhalam Aavo Ne (Garba Reprise)', 'vhalam-aavo-ne-garba-reprise', 6, 3, 8, 194, 'https://youtu.be/5gIpqS-Qpzw', '5gIpqS-Qpzw', 'https://i.ytimg.com/vi/5gIpqS-Qpzw/hqdefault.jpg', 'Hech', 'Modern', 'Ahmedabad', 'વ્હાલમ આવો ને, વ્હાલમ આવો ને...\nમંદિરમાં દીવો બળે, હૈયે હેત ના અજવાળા રે.', 430000, 1, 1),
(14, 'Kesariyo Rang Tane Lagyo Re', 'kesariyo-rang-tane-lagyo-re', 4, 5, 2, 195, 'https://youtu.be/rLsJlT-kV-I', 'rLsJlT-kV-I', 'https://i.ytimg.com/vi/rLsJlT-kV-I/hqdefault.jpg', '3-Taali', 'Modern', 'Saurashtra', 'કેસરિયો રંગ તને લાગ્યો રે લોલ...\nગરબે ઘૂમતા કસુંબલ રંગે રંગાયા રે!', 510000, 1, 1),
(15, 'Maa No Garbo Re Rame Ambe Maa', 'maa-no-garbo-re-rame-ambe-maa', 7, 7, 7, 360, '', NULL, '/assets/images/default-album.png', 'Aradhiya', 'Traditional', 'Maa Ambe Stuti', 'મા નો ગરબો રે રમે પાવાગઢ વાળી...\nસોના ના કળશે માંડવડી રોપાવી રે.', 145000, 0, 0),
(16, 'Mitha Moraliya', 'mitha-moraliya', 4, 5, 4, 267, '', NULL, '/assets/images/default-album.png', 'Folk', 'Modern', 'Saurashtra', 'મીઠા મોરલિયા બોલે રે ગઢ ગિરનાર પર...\nરૂપાળી રાધા ગરબે ઘૂમે, કાન કુંવર સંગ તાલ પુરાવે રે.', 340000, 1, 1),
(17, 'Best of Aditya Gadhvi Non stop', 'best-of-aditya-gadhvi-non-stop', 6, 3, 2, 1845, 'https://youtu.be/MASCw3qDBsQ', 'MASCw3qDBsQ', 'https://i.ytimg.com/vi/MASCw3qDBsQ/hqdefault.jpg', 'Nonstop', 'Modern', 'Saurashtra', 'આદિત્ય ગઢવી ના સુર સાથે નોનસ્ટોપ ગરબા ની રમઝટ...\nહે કાનુડો માંગ્યો દે ને જશોદા મૈયા...\nમોર બની થનગનાટ કરે, રંગભીની રાધા...', 350000, 1, 1),
(18, 'Kamariya (Mitron Garba)', 'kamariya-mitron-garba', 11, 11, 8, 187, 'https://youtu.be/i0_m90T04uw', 'i0_m90T04uw', 'https://i.ytimg.com/vi/i0_m90T04uw/hqdefault.jpg', 'Fusion', 'Modern', 'Ahmedabad', 'હૈયે હરખ ના માય રે, રાધા નાચે કાનુડો ગાય રે...\nકમરિયા લચકે રે બાબુ કમરિયા લચકે રે!\nડીજે ના ધબકારે આખું આંગણિયું ગુંજી ઊઠે રે.', 640000, 1, 1),
(19, 'Gori Radha Ne Kalo Kaan', 'gori-radha-ne-kalo-kaan', 4, 5, 2, 178, 'https://youtu.be/ccqg6e2rfLU', 'ccqg6e2rfLU', 'https://i.ytimg.com/vi/ccqg6e2rfLU/hqdefault.jpg', '3-Taali', 'Modern', 'Saurashtra', 'ગોરી રાધા ને કાળો કાન, ગરબે ઘૂમે ભૂલી ભાન...\nહે રાધા ના કાનુડા, ગરબે રમવા આવ ને રે!\nઝાંઝર ઝણકે પગલે પગલે તાલ મિલાવજે રે.', 720000, 1, 1),
(20, 'Pankhida Tu Udi Jaje DJ', 'pankhida-tu-udi-jaje-dj', 13, 13, 1, 126, 'https://youtu.be/5cAISqItql8', '5cAISqItql8', 'https://i.ytimg.com/vi/5cAISqItql8/hqdefault.jpg', '2-Taali', 'Modern', 'Saurashtra', 'પંખીડા તું ઊડી જાજે પાવાગઢ રે...\nમારી મહાકાળી ને જઈને કહેજે ગરબે રમે રે!\nમાડી તારા તેડું આવે તો અમે દોડ્યા આવીએ રે.', 310000, 1, 1),
(21, 'Radha Ne Shyam Mali Jashe', 'radha-ne-shyam-mali-jashe', 12, 12, 8, 277, 'https://youtu.be/tTfF5klskmo', 'tTfF5klskmo', 'https://i.ytimg.com/vi/tTfF5klskmo/hqdefault.jpg', 'Raas', 'Modern', 'Ahmedabad', 'રાધા ને શ્યામ મળી જાશે તો વાત બની જાશે...\nહે તારી વાંસળી ના સૂરે મન મોહી લેશે રે!\nગરબે ઘૂમતા હૈયા ના તાર જોડાયા રે.', 540000, 1, 1),
(22, 'Naagar Nandji Na Laal', 'naagar-nandji-na-laal', 6, 3, 4, 315, 'https://youtu.be/iraezTzB938', 'iraezTzB938', 'https://i.ytimg.com/vi/iraezTzB938/hqdefault.jpg', 'Hech', 'Modern', 'Saurashtra', 'નાગર નંદજી ના લાલ, રાસ રમંતા મારો હાર તૂટ્યો રે...\nકાનુડા તારા રંગે રંગાણી, હે રાધા ઘેલી થઈ રે!\nમોરલી વાગે ને મનડું નાચે રે.', 470000, 1, 1),
(23, 'Abhale Thi Utari Maa - Garbe Ramva Aavo', 'abhale-thi-utari-maa-garbe-ramva-aavo', 14, 14, 7, 520, 'https://youtu.be/CJRGtgQBxno', 'CJRGtgQBxno', 'https://i.ytimg.com/vi/CJRGtgQBxno/hqdefault.jpg', 'Aradhiya', 'Traditional', 'Maa Ambe Stuti', 'આભલે થી ઊતરી માં ગરબે રમવા આવો...\nચાંદો સૂરજ સાખ પૂરે, અંબા માં ના પગલે કંકુ વરસે રે!\nહે માવડી તારી કૃપા અવિરત વરસતી રહે.', 280000, 1, 1),
(24, 'Maadi Tara Mandiryama Ghantarav Vage', 'maadi-tara-mandiryama-ghantarav-vage', 5, 6, 7, 434, 'https://youtu.be/Wh-3Dk7A0vg', 'Wh-3Dk7A0vg', 'https://i.ytimg.com/vi/Wh-3Dk7A0vg/hqdefault.jpg', 'Dakla', 'Modern', 'Kutch', 'માડી તારા મંદિરમાં ઘંટારવ વાગે રે...\nકંકુ ભરી થાળી લઈને અંબા તારી આરતી ઉતારું રે!\nકચ્છ ધરા ની પુણ્ય ભૂમિ પર માવડી ના ચરણો પખાળું.', 410000, 1, 1),
(25, 'Mathura Ma Vagi Morli', 'mathura-ma-vagi-morli', 16, 16, 1, 239, 'https://youtu.be/B4qSyd48zTs', 'B4qSyd48zTs', 'https://i.ytimg.com/vi/B4qSyd48zTs/hqdefault.jpg', '2-Taali', 'Traditional', 'Saurashtra', 'મથુરા માં વાગી મોરલી ને ગોકુળ માં થયો નાદ રે...\nવાંસળી ના સૂરે રાધા ઘેલી થઈ, કાના સંગ ગરબે ઘૂમે રે!', 380000, 1, 1),
(26, 'Amba Tu Aavje Maa', 'amba-tu-aavje-maa', 17, 17, 7, 296, 'https://youtu.be/atKTqi9ID7A', 'atKTqi9ID7A', 'https://i.ytimg.com/vi/atKTqi9ID7A/hqdefault.jpg', 'Aradhiya', 'Modern', 'Maa Ambe Stuti', 'અંબા તું આવજે માં, ગરબે રમવા આવજે માં...\nભક્તો ના આંગણિયે દીવડા પ્રગટ્યા, આશીર્વાદ વરસાવજે માં!', 420000, 1, 1),
(27, 'Phoolde Shangaru Maa Tari Chundadi', 'phoolde-shangaru-maa-tari-chundadi', 7, 7, 7, 578, 'https://youtu.be/zfx85YYAFjU', 'zfx85YYAFjU', 'https://i.ytimg.com/vi/zfx85YYAFjU/hqdefault.jpg', 'Aradhiya', 'Traditional', 'Maa Ambe Stuti', 'ફૂલડે શણગારું માં તારી ચુંદડી...\nમોતીડે મઢાવું તારો ચૂડલો રે!\nગબ્બર વાળી માવડી, તારા પગલે કંકુ ના છાંટણાં રે.', 510000, 1, 1),
(28, 'Garbe Ramva Jau Mare', 'garbe-ramva-jau-mare', 18, 18, 2, 319, 'https://youtu.be/s-QIqX0sjSs', 's-QIqX0sjSs', 'https://i.ytimg.com/vi/s-QIqX0sjSs/hqdefault.jpg', '3-Taali', 'Modern', 'Ahmedabad', 'ગરબે રમવા જાઉં મારે, ઢોલ ના તાલે ઝૂમવું છે...\nઝાંઝરિયું ઝમકે પગલે પગલે, ચોગાળા સંગ ઘૂમવું છે!', 360000, 1, 1),
(29, 'Garbe Goomva De', 'garbe-goomva-de', 3, 4, 1, 311, 'https://youtu.be/lmk3idf_e8s', 'lmk3idf_e8s', 'https://i.ytimg.com/vi/lmk3idf_e8s/hqdefault.jpg', '2-Taali', 'Modern', 'Saurashtra', 'ગરબે ઘૂમવા દે મને ગરબે ઘૂમવા દે...\nનવ નવ રાત ની રઢીયાળી રમઝટ માં મહાલવા દે!', 395000, 1, 1),
(30, 'Moti Veraana (Songs of Faith)', 'moti-veraana-songs-of-faith', 15, 15, 8, 238, 'https://youtu.be/Jv8KRwF1zQs', 'Jv8KRwF1zQs', 'https://i.ytimg.com/vi/Jv8KRwF1zQs/hqdefault.jpg', 'Hech', 'Modern', 'Saurashtra', 'મોતી વેરાણા ચોક માં, માવડી પધાર્યા આંગણે...\nતાલી ના તાલે ગૂંજે સંસાર, હે માવડી તારી અસીમ કૃપા!', 950000, 1, 1);

-- Playlists
INSERT OR IGNORE INTO playlists (id, user_id, title, description, is_public) VALUES
(1, 1, 'Top 10 United Way Classics', 'The gold standard of Baroda Navratri ground tracks by Atul Purohit.', 1),
(2, 1, 'Non-Stop 3-Taali Fire', 'High energy continuous triple-clap songs to keep you spinning all night.', 1),
(3, 2, 'My Midnight Garba Favorites', 'Hand-picked personal favorites for late-night dandiya rounds.', 1);

-- Playlist Songs
INSERT OR IGNORE INTO playlist_songs (playlist_id, song_id) VALUES
(1, 1), (1, 10), (1, 8), (1, 23), (1, 26), (1, 27),
(2, 1), (2, 3), (2, 4), (2, 12), (2, 14), (2, 17), (2, 18), (2, 19), (2, 20), (2, 21), (2, 22), (2, 24), (2, 25), (2, 28), (2, 29), (2, 30),
(3, 2), (3, 5), (3, 6), (3, 9), (3, 13), (3, 17), (3, 18), (3, 19), (3, 21), (3, 25), (3, 30);

-- Favorites
INSERT OR IGNORE INTO favorites (user_id, song_id) VALUES
(2, 1), (2, 2), (2, 3), (2, 6), (2, 9);

-- Notifications
INSERT OR IGNORE INTO notifications (user_id, title, message, type, is_read) VALUES
(1, 'Welcome to Garba26!', 'Explore thousands of legendary garba tracks, join live Circles, and celebrate heritage folk.', 'welcome', 0),
(2, 'New Release from Aditya Gadhvi', 'Check out the new live acoustic folk rendition on Garba26!', 'release', 0);

-- Circles (Live Listening Rooms)
INSERT OR IGNORE INTO circles (id, code, name, host_user_id, current_song_id, current_playback_time, is_playing) VALUES
(1, 'BARODA26', 'United Way Night Owls 🌙', 1, 1, 45.0, 1),
(2, 'DANDIYA', 'Ahmedabad Heritage Circle 💃', 2, 2, 12.0, 1);

INSERT OR IGNORE INTO circle_members (circle_id, user_id) VALUES
(1, 1), (1, 2),
(2, 2), (2, 1);

INSERT OR IGNORE INTO circle_messages (circle_id, user_id, message) VALUES
(1, 1, 'Jay Ambe! Welcome to the United Way room everyone. Turn up the volume! 🥁'),
(1, 2, 'Atul bhai singing Tara Vina Shyam is pure goosebumps every time! ✨'),
(2, 2, 'Khalasi beat drop coming in 10 seconds! ⚡');
