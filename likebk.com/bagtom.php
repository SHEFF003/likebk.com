<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

$stats = array(
	array( // row #0
		'id' => 33,
		'priemslot' => 12,
	),
	array( // row #1
		'id' => 187049,
		'priemslot' => 11,
	),
	array( // row #2
		'id' => 180914,
		'priemslot' => 12,
	),
	array( // row #3
		'id' => 207394,
		'priemslot' => 11,
	),
	array( // row #4
		'id' => 201938,
		'priemslot' => 12,
	),
	array( // row #5
		'id' => 179363,
		'priemslot' => 16,
	),
	array( // row #6
		'id' => 185177,
		'priemslot' => 11,
	),
	array( // row #7
		'id' => 155,
		'priemslot' => 20,
	),
	array( // row #8
		'id' => 195374,
		'priemslot' => 11,
	),
	array( // row #9
		'id' => 183624,
		'priemslot' => 14,
	),
	array( // row #10
		'id' => 188376,
		'priemslot' => 12,
	),
	array( // row #11
		'id' => 201129,
		'priemslot' => 12,
	),
	array( // row #12
		'id' => 198739,
		'priemslot' => 12,
	),
	array( // row #13
		'id' => 197425,
		'priemslot' => 16,
	),
	array( // row #14
		'id' => 190614,
		'priemslot' => 13,
	),
	array( // row #15
		'id' => 204581,
		'priemslot' => 13,
	),
	array( // row #16
		'id' => 202090,
		'priemslot' => 14,
	),
	array( // row #17
		'id' => 219624,
		'priemslot' => 11,
	),
	array( // row #18
		'id' => 201973,
		'priemslot' => 14,
	),
	array( // row #19
		'id' => 199149,
		'priemslot' => 14,
	),
	array( // row #20
		'id' => 201953,
		'priemslot' => 11,
	),
	array( // row #21
		'id' => 177006,
		'priemslot' => 11,
	),
	array( // row #22
		'id' => 202491,
		'priemslot' => 13,
	),
	array( // row #23
		'id' => 215968,
		'priemslot' => 12,
	),
	array( // row #24
		'id' => 207620,
		'priemslot' => 14,
	),
	array( // row #25
		'id' => 216454,
		'priemslot' => 14,
	),
	array( // row #26
		'id' => 214223,
		'priemslot' => 12,
	),
	array( // row #27
		'id' => 218249,
		'priemslot' => 12,
	),
	array( // row #28
		'id' => 210714,
		'priemslot' => 12,
	),
	array( // row #29
		'id' => 207586,
		'priemslot' => 11,
	),
	array( // row #30
		'id' => 219850,
		'priemslot' => 11,
	),
	array( // row #31
		'id' => 211618,
		'priemslot' => 14,
	),
	array( // row #32
		'id' => 1425119,
		'priemslot' => 11,
	),
	array( // row #33
		'id' => 854428,
		'priemslot' => 12,
	),
	array( // row #34
		'id' => 1830660,
		'priemslot' => 11,
	),
	array( // row #35
		'id' => 178436,
		'priemslot' => 12,
	),
	array( // row #36
		'id' => 193359,
		'priemslot' => 11,
	),
	array( // row #37
		'id' => 180746,
		'priemslot' => 11,
	),
	array( // row #38
		'id' => 184331,
		'priemslot' => 12,
	),
	array( // row #39
		'id' => 182826,
		'priemslot' => 12,
	),
	array( // row #40
		'id' => 16901,
		'priemslot' => 12,
	),
	array( // row #41
		'id' => 851271,
		'priemslot' => 14,
	),
	array( // row #42
		'id' => 1424932,
		'priemslot' => 16,
	),
	array( // row #43
		'id' => 181421,
		'priemslot' => 11,
	),
	array( // row #44
		'id' => 13011,
		'priemslot' => 14,
	),
	array( // row #45
		'id' => 185950,
		'priemslot' => 13,
	),
	array( // row #46
		'id' => 13043,
		'priemslot' => 12,
	),
	array( // row #47
		'id' => 13089,
		'priemslot' => 14,
	),
	array( // row #48
		'id' => 13682,
		'priemslot' => 11,
	),
	array( // row #49
		'id' => 14413,
		'priemslot' => 14,
	),
	array( // row #50
		'id' => 13335,
		'priemslot' => 14,
	),
	array( // row #51
		'id' => 14609,
		'priemslot' => 12,
	),
	array( // row #52
		'id' => 13770,
		'priemslot' => 14,
	),
	array( // row #53
		'id' => 14151,
		'priemslot' => 11,
	),
	array( // row #54
		'id' => 14312,
		'priemslot' => 12,
	),
	array( // row #55
		'id' => 14643,
		'priemslot' => 11,
	),
	array( // row #56
		'id' => 14558,
		'priemslot' => 16,
	),
	array( // row #57
		'id' => 14595,
		'priemslot' => 16,
	),
	array( // row #58
		'id' => 16555,
		'priemslot' => 11,
	),
	array( // row #59
		'id' => 180845,
		'priemslot' => 11,
	),
	array( // row #60
		'id' => 15060,
		'priemslot' => 13,
	),
	array( // row #61
		'id' => 12345,
		'priemslot' => 20,
	),
	array( // row #62
		'id' => 16646,
		'priemslot' => 14,
	),
	array( // row #63
		'id' => 182921,
		'priemslot' => 12,
	),
	array( // row #64
		'id' => 17072,
		'priemslot' => 11,
	),
	array( // row #65
		'id' => 17188,
		'priemslot' => 14,
	),
	array( // row #66
		'id' => 17610,
		'priemslot' => 11,
	),
	array( // row #67
		'id' => 18227,
		'priemslot' => 12,
	),
	array( // row #68
		'id' => 19334,
		'priemslot' => 11,
	),
	array( // row #69
		'id' => 20079,
		'priemslot' => 14,
	),
	array( // row #70
		'id' => 20199,
		'priemslot' => 11,
	),
	array( // row #71
		'id' => 20326,
		'priemslot' => 11,
	),
	array( // row #72
		'id' => 24398,
		'priemslot' => 11,
	),
	array( // row #73
		'id' => 20667,
		'priemslot' => 11,
	),
	array( // row #74
		'id' => 21365,
		'priemslot' => 11,
	),
	array( // row #75
		'id' => 21259,
		'priemslot' => 14,
	),
	array( // row #76
		'id' => 21354,
		'priemslot' => 13,
	),
	array( // row #77
		'id' => 21525,
		'priemslot' => 12,
	),
	array( // row #78
		'id' => 22270,
		'priemslot' => 11,
	),
	array( // row #79
		'id' => 22736,
		'priemslot' => 14,
	),
	array( // row #80
		'id' => 22693,
		'priemslot' => 14,
	),
	array( // row #81
		'id' => 25035,
		'priemslot' => 13,
	),
	array( // row #82
		'id' => 24033,
		'priemslot' => 12,
	),
	array( // row #83
		'id' => 24459,
		'priemslot' => 14,
	),
	array( // row #84
		'id' => 25080,
		'priemslot' => 14,
	),
	array( // row #85
		'id' => 31762,
		'priemslot' => 11,
	),
	array( // row #86
		'id' => 25323,
		'priemslot' => 12,
	),
	array( // row #87
		'id' => 25287,
		'priemslot' => 11,
	),
	array( // row #88
		'id' => 25422,
		'priemslot' => 14,
	),
	array( // row #89
		'id' => 25857,
		'priemslot' => 13,
	),
	array( // row #90
		'id' => 25746,
		'priemslot' => 11,
	),
	array( // row #91
		'id' => 25916,
		'priemslot' => 12,
	),
	array( // row #92
		'id' => 27367,
		'priemslot' => 11,
	),
	array( // row #93
		'id' => 26564,
		'priemslot' => 11,
	),
	array( // row #94
		'id' => 27926,
		'priemslot' => 14,
	),
	array( // row #95
		'id' => 27311,
		'priemslot' => 11,
	),
	array( // row #96
		'id' => 27574,
		'priemslot' => 13,
	),
	array( // row #97
		'id' => 29718,
		'priemslot' => 11,
	),
	array( // row #98
		'id' => 27969,
		'priemslot' => 14,
	),
	array( // row #99
		'id' => 28422,
		'priemslot' => 11,
	),
	array( // row #100
		'id' => 42186,
		'priemslot' => 11,
	),
	array( // row #101
		'id' => 46406,
		'priemslot' => 14,
	),
	array( // row #102
		'id' => 29739,
		'priemslot' => 11,
	),
	array( // row #103
		'id' => 32058,
		'priemslot' => 12,
	),
	array( // row #104
		'id' => 34001,
		'priemslot' => 11,
	),
	array( // row #105
		'id' => 32657,
		'priemslot' => 11,
	),
	array( // row #106
		'id' => 66385,
		'priemslot' => 12,
	),
	array( // row #107
		'id' => 35636,
		'priemslot' => 14,
	),
	array( // row #108
		'id' => 36947,
		'priemslot' => 14,
	),
	array( // row #109
		'id' => 36404,
		'priemslot' => 12,
	),
	array( // row #110
		'id' => 38297,
		'priemslot' => 12,
	),
	array( // row #111
		'id' => 37645,
		'priemslot' => 11,
	),
	array( // row #112
		'id' => 38302,
		'priemslot' => 11,
	),
	array( // row #113
		'id' => 71002,
		'priemslot' => 12,
	),
	array( // row #114
		'id' => 40794,
		'priemslot' => 11,
	),
	array( // row #115
		'id' => 45962,
		'priemslot' => 12,
	),
	array( // row #116
		'id' => 45278,
		'priemslot' => 14,
	),
	array( // row #117
		'id' => 44105,
		'priemslot' => 12,
	),
	array( // row #118
		'id' => 44742,
		'priemslot' => 12,
	),
	array( // row #119
		'id' => 54653,
		'priemslot' => 11,
	),
	array( // row #120
		'id' => 47895,
		'priemslot' => 14,
	),
	array( // row #121
		'id' => 53253,
		'priemslot' => 11,
	),
	array( // row #122
		'id' => 49745,
		'priemslot' => 13,
	),
	array( // row #123
		'id' => 49706,
		'priemslot' => 12,
	),
	array( // row #124
		'id' => 60716,
		'priemslot' => 11,
	),
	array( // row #125
		'id' => 51273,
		'priemslot' => 11,
	),
	array( // row #126
		'id' => 53487,
		'priemslot' => 11,
	),
	array( // row #127
		'id' => 52612,
		'priemslot' => 11,
	),
	array( // row #128
		'id' => 54679,
		'priemslot' => 14,
	),
	array( // row #129
		'id' => 55916,
		'priemslot' => 12,
	),
	array( // row #130
		'id' => 55848,
		'priemslot' => 11,
	),
	array( // row #131
		'id' => 58798,
		'priemslot' => 13,
	),
	array( // row #132
		'id' => 58431,
		'priemslot' => 14,
	),
	array( // row #133
		'id' => 58038,
		'priemslot' => 11,
	),
	array( // row #134
		'id' => 59799,
		'priemslot' => 11,
	),
	array( // row #135
		'id' => 58188,
		'priemslot' => 11,
	),
	array( // row #136
		'id' => 61983,
		'priemslot' => 16,
	),
	array( // row #137
		'id' => 71830,
		'priemslot' => 11,
	),
	array( // row #138
		'id' => 66059,
		'priemslot' => 13,
	),
	array( // row #139
		'id' => 68077,
		'priemslot' => 12,
	),
	array( // row #140
		'id' => 69447,
		'priemslot' => 16,
	),
	array( // row #141
		'id' => 71181,
		'priemslot' => 12,
	),
	array( // row #142
		'id' => 72446,
		'priemslot' => 11,
	),
	array( // row #143
		'id' => 73166,
		'priemslot' => 12,
	),
	array( // row #144
		'id' => 73774,
		'priemslot' => 14,
	),
	array( // row #145
		'id' => 76150,
		'priemslot' => 11,
	),
	array( // row #146
		'id' => 77334,
		'priemslot' => 12,
	),
	array( // row #147
		'id' => 79769,
		'priemslot' => 11,
	),
	array( // row #148
		'id' => 80885,
		'priemslot' => 12,
	),
	array( // row #149
		'id' => 81484,
		'priemslot' => 11,
	),
	array( // row #150
		'id' => 93092,
		'priemslot' => 11,
	),
	array( // row #151
		'id' => 84723,
		'priemslot' => 11,
	),
	array( // row #152
		'id' => 104254,
		'priemslot' => 11,
	),
	array( // row #153
		'id' => 92638,
		'priemslot' => 12,
	),
	array( // row #154
		'id' => 119822,
		'priemslot' => 16,
	),
	array( // row #155
		'id' => 187744,
		'priemslot' => 11,
	),
	array( // row #156
		'id' => 83892,
		'priemslot' => 13,
	),
	array( // row #157
		'id' => 123421,
		'priemslot' => 11,
	),
	array( // row #158
		'id' => 92747,
		'priemslot' => 11,
	),
	array( // row #159
		'id' => 92913,
		'priemslot' => 11,
	),
	array( // row #160
		'id' => 93098,
		'priemslot' => 11,
	),
	array( // row #161
		'id' => 93018,
		'priemslot' => 12,
	),
	array( // row #162
		'id' => 88654,
		'priemslot' => 11,
	),
	array( // row #163
		'id' => 114108,
		'priemslot' => 13,
	),
	array( // row #164
		'id' => 87729,
		'priemslot' => 14,
	),
	array( // row #165
		'id' => 87363,
		'priemslot' => 16,
	),
	array( // row #166
		'id' => 91105,
		'priemslot' => 14,
	),
	array( // row #167
		'id' => 88668,
		'priemslot' => 12,
	),
	array( // row #168
		'id' => 87721,
		'priemslot' => 13,
	),
	array( // row #169
		'id' => 88569,
		'priemslot' => 12,
	),
	array( // row #170
		'id' => 89361,
		'priemslot' => 11,
	),
	array( // row #171
		'id' => 90561,
		'priemslot' => 12,
	),
	array( // row #172
		'id' => 90267,
		'priemslot' => 12,
	),
	array( // row #173
		'id' => 90441,
		'priemslot' => 16,
	),
	array( // row #174
		'id' => 95242,
		'priemslot' => 16,
	),
	array( // row #175
		'id' => 95084,
		'priemslot' => 13,
	),
	array( // row #176
		'id' => 181064,
		'priemslot' => 11,
	),
	array( // row #177
		'id' => 109274,
		'priemslot' => 12,
	),
	array( // row #178
		'id' => 103391,
		'priemslot' => 12,
	),
	array( // row #179
		'id' => 99013,
		'priemslot' => 11,
	),
	array( // row #180
		'id' => 113469,
		'priemslot' => 11,
	),
	array( // row #181
		'id' => 99018,
		'priemslot' => 13,
	),
	array( // row #182
		'id' => 101136,
		'priemslot' => 12,
	),
	array( // row #183
		'id' => 102365,
		'priemslot' => 11,
	),
	array( // row #184
		'id' => 102420,
		'priemslot' => 12,
	),
	array( // row #185
		'id' => 102340,
		'priemslot' => 12,
	),
	array( // row #186
		'id' => 102827,
		'priemslot' => 11,
	),
	array( // row #187
		'id' => 110995,
		'priemslot' => 11,
	),
	array( // row #188
		'id' => 104594,
		'priemslot' => 14,
	),
	array( // row #189
		'id' => 104853,
		'priemslot' => 16,
	),
	array( // row #190
		'id' => 110091,
		'priemslot' => 11,
	),
	array( // row #191
		'id' => 105095,
		'priemslot' => 11,
	),
	array( // row #192
		'id' => 105300,
		'priemslot' => 12,
	),
	array( // row #193
		'id' => 106824,
		'priemslot' => 14,
	),
	array( // row #194
		'id' => 113225,
		'priemslot' => 12,
	),
	array( // row #195
		'id' => 108592,
		'priemslot' => 11,
	),
	array( // row #196
		'id' => 107679,
		'priemslot' => 12,
	),
	array( // row #197
		'id' => 107568,
		'priemslot' => 12,
	),
	array( // row #198
		'id' => 119963,
		'priemslot' => 12,
	),
	array( // row #199
		'id' => 117600,
		'priemslot' => 16,
	),
	array( // row #200
		'id' => 119177,
		'priemslot' => 12,
	),
	array( // row #201
		'id' => 143331,
		'priemslot' => 11,
	),
	array( // row #202
		'id' => 125599,
		'priemslot' => 11,
	),
	array( // row #203
		'id' => 125571,
		'priemslot' => 13,
	),
	array( // row #204
		'id' => 126848,
		'priemslot' => 12,
	),
	array( // row #205
		'id' => 127495,
		'priemslot' => 11,
	),
	array( // row #206
		'id' => 164756,
		'priemslot' => 11,
	),
	array( // row #207
		'id' => 137073,
		'priemslot' => 13,
	),
	array( // row #208
		'id' => 132403,
		'priemslot' => 12,
	),
	array( // row #209
		'id' => 138687,
		'priemslot' => 11,
	),
	array( // row #210
		'id' => 131812,
		'priemslot' => 13,
	),
	array( // row #211
		'id' => 135556,
		'priemslot' => 13,
	),
	array( // row #212
		'id' => 139346,
		'priemslot' => 12,
	),
	array( // row #213
		'id' => 144168,
		'priemslot' => 12,
	),
	array( // row #214
		'id' => 143417,
		'priemslot' => 16,
	),
	array( // row #215
		'id' => 144688,
		'priemslot' => 14,
	),
	array( // row #216
		'id' => 144906,
		'priemslot' => 14,
	),
	array( // row #217
		'id' => 164301,
		'priemslot' => 14,
	),
	array( // row #218
		'id' => 162039,
		'priemslot' => 12,
	),
	array( // row #219
		'id' => 162250,
		'priemslot' => 14,
	),
	array( // row #220
		'id' => 162077,
		'priemslot' => 11,
	),
	array( // row #221
		'id' => 148805,
		'priemslot' => 12,
	),
	array( // row #222
		'id' => 157223,
		'priemslot' => 12,
	),
	array( // row #223
		'id' => 161353,
		'priemslot' => 11,
	),
	array( // row #224
		'id' => 160146,
		'priemslot' => 12,
	),
	array( // row #225
		'id' => 148993,
		'priemslot' => 12,
	),
	array( // row #226
		'id' => 161418,
		'priemslot' => 14,
	),
	array( // row #227
		'id' => 150561,
		'priemslot' => 13,
	),
	array( // row #228
		'id' => 150602,
		'priemslot' => 14,
	),
	array( // row #229
		'id' => 158551,
		'priemslot' => 13,
	),
	array( // row #230
		'id' => 170203,
		'priemslot' => 12,
	),
	array( // row #231
		'id' => 155281,
		'priemslot' => 12,
	),
	array( // row #232
		'id' => 157089,
		'priemslot' => 11,
	),
	array( // row #233
		'id' => 782665,
		'priemslot' => 13,
	),
	array( // row #234
		'id' => 156226,
		'priemslot' => 14,
	),
	array( // row #235
		'id' => 166219,
		'priemslot' => 12,
	),
	array( // row #236
		'id' => 171319,
		'priemslot' => 12,
	),
	array( // row #237
		'id' => 2075043,
		'priemslot' => 12,
	),
	array( // row #238
		'id' => 209447,
		'priemslot' => 12,
	),
	array( // row #239
		'id' => 170375,
		'priemslot' => 12,
	),
	array( // row #240
		'id' => 172509,
		'priemslot' => 13,
	),
	array( // row #241
		'id' => 172087,
		'priemslot' => 12,
	),
	array( // row #242
		'id' => 172536,
		'priemslot' => 12,
	),
	array( // row #243
		'id' => 220461,
		'priemslot' => 16,
	),
	array( // row #244
		'id' => 220516,
		'priemslot' => 12,
	),
	array( // row #245
		'id' => 220421,
		'priemslot' => 11,
	),
	array( // row #246
		'id' => 220588,
		'priemslot' => 11,
	),
	array( // row #247
		'id' => 446583,
		'priemslot' => 13,
	),
	array( // row #248
		'id' => 225320,
		'priemslot' => 11,
	),
	array( // row #249
		'id' => 224637,
		'priemslot' => 12,
	),
	array( // row #250
		'id' => 1969861,
		'priemslot' => 11,
	),
	array( // row #251
		'id' => 278265,
		'priemslot' => 14,
	),
	array( // row #252
		'id' => 229411,
		'priemslot' => 11,
	),
	array( // row #253
		'id' => 231819,
		'priemslot' => 16,
	),
	array( // row #254
		'id' => 230998,
		'priemslot' => 11,
	),
	array( // row #255
		'id' => 234543,
		'priemslot' => 12,
	),
	array( // row #256
		'id' => 233187,
		'priemslot' => 11,
	),
	array( // row #257
		'id' => 238619,
		'priemslot' => 13,
	),
	array( // row #258
		'id' => 236886,
		'priemslot' => 11,
	),
	array( // row #259
		'id' => 233859,
		'priemslot' => 12,
	),
	array( // row #260
		'id' => 274818,
		'priemslot' => 14,
	),
	array( // row #261
		'id' => 238926,
		'priemslot' => 12,
	),
	array( // row #262
		'id' => 240466,
		'priemslot' => 11,
	),
	array( // row #263
		'id' => 290666,
		'priemslot' => 11,
	),
	array( // row #264
		'id' => 641275,
		'priemslot' => 13,
	),
	array( // row #265
		'id' => 257446,
		'priemslot' => 11,
	),
	array( // row #266
		'id' => 258034,
		'priemslot' => 11,
	),
	array( // row #267
		'id' => 245252,
		'priemslot' => 12,
	),
	array( // row #268
		'id' => 254894,
		'priemslot' => 11,
	),
	array( // row #269
		'id' => 254216,
		'priemslot' => 11,
	),
	array( // row #270
		'id' => 253700,
		'priemslot' => 12,
	),
	array( // row #271
		'id' => 253596,
		'priemslot' => 11,
	),
	array( // row #272
		'id' => 274060,
		'priemslot' => 14,
	),
	array( // row #273
		'id' => 270543,
		'priemslot' => 12,
	),
	array( // row #274
		'id' => 247713,
		'priemslot' => 14,
	),
	array( // row #275
		'id' => 266441,
		'priemslot' => 13,
	),
	array( // row #276
		'id' => 441938,
		'priemslot' => 13,
	),
	array( // row #277
		'id' => 252948,
		'priemslot' => 14,
	),
	array( // row #278
		'id' => 252803,
		'priemslot' => 11,
	),
	array( // row #279
		'id' => 288563,
		'priemslot' => 13,
	),
	array( // row #280
		'id' => 260006,
		'priemslot' => 11,
	),
	array( // row #281
		'id' => 265233,
		'priemslot' => 11,
	),
	array( // row #282
		'id' => 277373,
		'priemslot' => 11,
	),
	array( // row #283
		'id' => 284972,
		'priemslot' => 11,
	),
	array( // row #284
		'id' => 265536,
		'priemslot' => 13,
	),
	array( // row #285
		'id' => 633212,
		'priemslot' => 12,
	),
	array( // row #286
		'id' => 263632,
		'priemslot' => 12,
	),
	array( // row #287
		'id' => 399325,
		'priemslot' => 12,
	),
	array( // row #288
		'id' => 283043,
		'priemslot' => 11,
	),
	array( // row #289
		'id' => 282282,
		'priemslot' => 11,
	),
	array( // row #290
		'id' => 408080,
		'priemslot' => 13,
	),
	array( // row #291
		'id' => 281315,
		'priemslot' => 12,
	),
	array( // row #292
		'id' => 328200,
		'priemslot' => 12,
	),
	array( // row #293
		'id' => 391143,
		'priemslot' => 12,
	),
	array( // row #294
		'id' => 399196,
		'priemslot' => 13,
	),
	array( // row #295
		'id' => 296059,
		'priemslot' => 12,
	),
	array( // row #296
		'id' => 359533,
		'priemslot' => 13,
	),
	array( // row #297
		'id' => 299462,
		'priemslot' => 12,
	),
	array( // row #298
		'id' => 298164,
		'priemslot' => 14,
	),
	array( // row #299
		'id' => 335881,
		'priemslot' => 12,
	),
	array( // row #300
		'id' => 354877,
		'priemslot' => 11,
	),
	array( // row #301
		'id' => 403605,
		'priemslot' => 12,
	),
	array( // row #302
		'id' => 255448,
		'priemslot' => 13,
	),
	array( // row #303
		'id' => 299809,
		'priemslot' => 11,
	),
	array( // row #304
		'id' => 344555,
		'priemslot' => 12,
	),
	array( // row #305
		'id' => 302669,
		'priemslot' => 12,
	),
	array( // row #306
		'id' => 342908,
		'priemslot' => 13,
	),
	array( // row #307
		'id' => 410060,
		'priemslot' => 13,
	),
	array( // row #308
		'id' => 321657,
		'priemslot' => 12,
	),

	array( // row #309
		'id' => 380139,
		'priemslot' => 12,
	),
	array( // row #310
		'id' => 392083,
		'priemslot' => 16,
	),
	array( // row #311
		'id' => 319083,
		'priemslot' => 14,
	),
	array( // row #312
		'id' => 318588,
		'priemslot' => 12,
	),
	array( // row #313
		'id' => 322818,
		'priemslot' => 11,
	),
	array( // row #314
		'id' => 397078,
		'priemslot' => 12,
	),
	array( // row #315
		'id' => 358278,
		'priemslot' => 12,
	),
	array( // row #316
		'id' => 315616,
		'priemslot' => 16,
	),
	array( // row #317
		'id' => 374684,
		'priemslot' => 11,
	),
	array( // row #318
		'id' => 395643,
		'priemslot' => 13,
	),
	array( // row #319
		'id' => 437699,
		'priemslot' => 11,
	),
	array( // row #320
		'id' => 400995,
		'priemslot' => 12,
	),
	array( // row #321
		'id' => 362038,
		'priemslot' => 13,
	),
	array( // row #322
		'id' => 725726,
		'priemslot' => 13,
	),
	array( // row #323
		'id' => 445200,
		'priemslot' => 11,
	),
	array( // row #324
		'id' => 379564,
		'priemslot' => 11,
	),
	array( // row #325
		'id' => 375727,
		'priemslot' => 12,
	),
	array( // row #326
		'id' => 401383,
		'priemslot' => 11,
	),
	array( // row #327
		'id' => 373783,
		'priemslot' => 13,
	),
	array( // row #328
		'id' => 400048,
		'priemslot' => 11,
	),
	array( // row #329
		'id' => 380210,
		'priemslot' => 11,
	),
	array( // row #330
		'id' => 377277,
		'priemslot' => 12,
	),
	array( // row #331
		'id' => 402235,
		'priemslot' => 11,
	),
	array( // row #332
		'id' => 380323,
		'priemslot' => 11,
	),
	array( // row #333
		'id' => 615618,
		'priemslot' => 11,
	),
	array( // row #334
		'id' => 418668,
		'priemslot' => 11,
	),
	array( // row #335
		'id' => 443527,
		'priemslot' => 14,
	),
	array( // row #336
		'id' => 670097,
		'priemslot' => 11,
	),
	array( // row #337
		'id' => 554548,
		'priemslot' => 11,
	),
	array( // row #338
		'id' => 417808,
		'priemslot' => 11,
	),
	array( // row #339
		'id' => 443563,
		'priemslot' => 12,
	),
	array( // row #340
		'id' => 432002,
		'priemslot' => 12,
	),
	array( // row #341
		'id' => 425774,
		'priemslot' => 11,
	),
	array( // row #342
		'id' => 669259,
		'priemslot' => 14,
	),
	array( // row #343
		'id' => 429064,
		'priemslot' => 13,
	),
	array( // row #344
		'id' => 654974,
		'priemslot' => 12,
	),
	array( // row #345
		'id' => 617553,
		'priemslot' => 13,
	),
	array( // row #346
		'id' => 633724,
		'priemslot' => 13,
	),
	array( // row #347
		'id' => 631471,
		'priemslot' => 14,
	),
	array( // row #348
		'id' => 638350,
		'priemslot' => 12,
	),
	array( // row #349
		'id' => 581644,
		'priemslot' => 13,
	),
	array( // row #350
		'id' => 614239,
		'priemslot' => 11,
	),
	array( // row #351
		'id' => 569433,
		'priemslot' => 11,
	),
	array( // row #352
		'id' => 490206,
		'priemslot' => 13,
	),
	array( // row #353
		'id' => 475154,
		'priemslot' => 16,
	),
	array( // row #354
		'id' => 638662,
		'priemslot' => 11,
	),
	array( // row #355
		'id' => 655750,
		'priemslot' => 13,
	),
	array( // row #356
		'id' => 461915,
		'priemslot' => 12,
	),
	array( // row #357
		'id' => 465800,
		'priemslot' => 12,
	),
	array( // row #358
		'id' => 502028,
		'priemslot' => 13,
	),
	array( // row #359
		'id' => 503525,
		'priemslot' => 11,
	),
	array( // row #360
		'id' => 469765,
		'priemslot' => 12,
	),
	array( // row #361
		'id' => 520353,
		'priemslot' => 11,
	),
	array( // row #362
		'id' => 641157,
		'priemslot' => 13,
	),
	array( // row #363
		'id' => 595692,
		'priemslot' => 11,
	),
	array( // row #364
		'id' => 723979,
		'priemslot' => 12,
	),
	array( // row #365
		'id' => 2239678,
		'priemslot' => 11,
	),
	array( // row #366
		'id' => 585825,
		'priemslot' => 11,
	),
	array( // row #367
		'id' => 522781,
		'priemslot' => 11,
	),
	array( // row #368
		'id' => 593651,
		'priemslot' => 12,
	),
	array( // row #369
		'id' => 2042644,
		'priemslot' => 12,
	),
	array( // row #370
		'id' => 684831,
		'priemslot' => 14,
	),
	array( // row #371
		'id' => 583222,
		'priemslot' => 11,
	),
	array( // row #372
		'id' => 483538,
		'priemslot' => 12,
	),
	array( // row #373
		'id' => 501971,
		'priemslot' => 11,
	),
	array( // row #374
		'id' => 642666,
		'priemslot' => 11,
	),
	array( // row #375
		'id' => 664650,
		'priemslot' => 11,
	),
	array( // row #376
		'id' => 645432,
		'priemslot' => 11,
	),
	array( // row #377
		'id' => 671191,
		'priemslot' => 11,
	),
	array( // row #378
		'id' => 634102,
		'priemslot' => 12,
	),
	array( // row #379
		'id' => 497712,
		'priemslot' => 11,
	),
	array( // row #380
		'id' => 525681,
		'priemslot' => 13,
	),
	array( // row #381
		'id' => 2214811,
		'priemslot' => 11,
	),
	array( // row #382
		'id' => 575075,
		'priemslot' => 12,
	),
	array( // row #383
		'id' => 562869,
		'priemslot' => 11,
	),
	array( // row #384
		'id' => 586055,
		'priemslot' => 11,
	),
	array( // row #385
		'id' => 607973,
		'priemslot' => 12,
	),
	array( // row #386
		'id' => 556619,
		'priemslot' => 11,
	),
	array( // row #387
		'id' => 613883,
		'priemslot' => 13,
	),
	array( // row #388
		'id' => 582195,
		'priemslot' => 12,
	),
	array( // row #389
		'id' => 556537,
		'priemslot' => 11,
	),
	array( // row #390
		'id' => 574761,
		'priemslot' => 11,
	),
	array( // row #391
		'id' => 556936,
		'priemslot' => 13,
	),
	array( // row #392
		'id' => 554937,
		'priemslot' => 11,
	),
	array( // row #393
		'id' => 547620,
		'priemslot' => 12,
	),
	array( // row #394
		'id' => 582742,
		'priemslot' => 11,
	),
	array( // row #395
		'id' => 552275,
		'priemslot' => 11,
	),
	array( // row #396
		'id' => 570640,
		'priemslot' => 11,
	),
	array( // row #397
		'id' => 574591,
		'priemslot' => 12,
	),
	array( // row #398
		'id' => 556170,
		'priemslot' => 12,
	),
	array( // row #399
		'id' => 593321,
		'priemslot' => 11,
	),
	array( // row #400
		'id' => 552116,
		'priemslot' => 11,
	),
	array( // row #401
		'id' => 551922,
		'priemslot' => 12,
	),
	array( // row #402
		'id' => 614550,
		'priemslot' => 12,
	),
	array( // row #403
		'id' => 610212,
		'priemslot' => 14,
	),
	array( // row #404
		'id' => 552764,
		'priemslot' => 11,
	),
	array( // row #405
		'id' => 633227,
		'priemslot' => 16,
	),
	array( // row #406
		'id' => 595707,
		'priemslot' => 11,
	),
	array( // row #407
		'id' => 552640,
		'priemslot' => 13,
	),
	array( // row #408
		'id' => 551817,
		'priemslot' => 12,
	),
	array( // row #409
		'id' => 679188,
		'priemslot' => 11,
	),
	array( // row #410
		'id' => 675219,
		'priemslot' => 12,
	),
	array( // row #411
		'id' => 2057581,
		'priemslot' => 11,
	),
	array( // row #412
		'id' => 721532,
		'priemslot' => 14,
	),
	array( // row #413
		'id' => 679637,
		'priemslot' => 12,
	),
	array( // row #414
		'id' => 686290,
		'priemslot' => 11,
	),
	array( // row #415
		'id' => 686353,
		'priemslot' => 12,
	),
	array( // row #416
		'id' => 718572,
		'priemslot' => 14,
	),
	array( // row #417
		'id' => 697589,
		'priemslot' => 11,
	),
	array( // row #418
		'id' => 698482,
		'priemslot' => 11,
	),
	array( // row #419
		'id' => 689863,
		'priemslot' => 11,
	),
	array( // row #420
		'id' => 724946,
		'priemslot' => 11,
	),
	array( // row #421
		'id' => 700954,
		'priemslot' => 13,
	),
	array( // row #422
		'id' => 2071808,
		'priemslot' => 11,
	),
	array( // row #423
		'id' => 720397,
		'priemslot' => 12,
	),
	array( // row #424
		'id' => 706443,
		'priemslot' => 11,
	),
	array( // row #425
		'id' => 724759,
		'priemslot' => 12,
	),
	array( // row #426
		'id' => 709519,
		'priemslot' => 16,
	),
	array( // row #427
		'id' => 713676,
		'priemslot' => 12,
	),
	array( // row #428
		'id' => 721908,
		'priemslot' => 11,
	),
	array( // row #429
		'id' => 715138,
		'priemslot' => 11,
	),
	array( // row #430
		'id' => 724752,
		'priemslot' => 11,
	),
	array( // row #431
		'id' => 734453,
		'priemslot' => 11,
	),
	array( // row #432
		'id' => 742269,
		'priemslot' => 11,
	),
	array( // row #433
		'id' => 766489,
		'priemslot' => 11,
	),
	array( // row #434
		'id' => 2095141,
		'priemslot' => 11,
	),
	array( // row #435
		'id' => 762180,
		'priemslot' => 11,
	),
	array( // row #436
		'id' => 741436,
		'priemslot' => 11,
	),
	array( // row #437
		'id' => 744473,
		'priemslot' => 11,
	),
	array( // row #438
		'id' => 753731,
		'priemslot' => 12,
	),
	array( // row #439
		'id' => 747231,
		'priemslot' => 11,
	),
	array( // row #440
		'id' => 772906,
		'priemslot' => 16,
	),
	array( // row #441
		'id' => 869630,
		'priemslot' => 11,
	),
	array( // row #442
		'id' => 772122,
		'priemslot' => 12,
	),
	array( // row #443
		'id' => 2093353,
		'priemslot' => 11,
	),
	array( // row #444
		'id' => 775804,
		'priemslot' => 11,
	),
	array( // row #445
		'id' => 765080,
		'priemslot' => 15,
	),
	array( // row #446
		'id' => 765908,
		'priemslot' => 11,
	),
	array( // row #447
		'id' => 956562,
		'priemslot' => 11,
	),
	array( // row #448
		'id' => 862070,
		'priemslot' => 11,
	),
	array( // row #449
		'id' => 822515,
		'priemslot' => 16,
	),
	array( // row #450
		'id' => 2021492,
		'priemslot' => 12,
	),
	array( // row #451
		'id' => 811123,
		'priemslot' => 11,
	),
	array( // row #452
		'id' => 791358,
		'priemslot' => 12,
	),
	array( // row #453
		'id' => 813723,
		'priemslot' => 14,
	),
	array( // row #454
		'id' => 2027235,
		'priemslot' => 12,
	),
	array( // row #455
		'id' => 807123,
		'priemslot' => 13,
	),
	array( // row #456
		'id' => 821936,
		'priemslot' => 12,
	),
	array( // row #457
		'id' => 850694,
		'priemslot' => 12,
	),
	array( // row #458
		'id' => 799983,
		'priemslot' => 14,
	),
	array( // row #459
		'id' => 872053,
		'priemslot' => 12,
	),
	array( // row #460
		'id' => 819030,
		'priemslot' => 14,
	),
	array( // row #461
		'id' => 821293,
		'priemslot' => 13,
	),
	array( // row #462
		'id' => 894267,
		'priemslot' => 13,
	),
	array( // row #463
		'id' => 919667,
		'priemslot' => 11,
	),
	array( // row #464
		'id' => 836165,
		'priemslot' => 11,
	),
	array( // row #465
		'id' => 857171,
		'priemslot' => 13,
	),
	array( // row #466
		'id' => 2055056,
		'priemslot' => 11,
	),
	array( // row #467
		'id' => 855070,
		'priemslot' => 11,
	),
	array( // row #468
		'id' => 861106,
		'priemslot' => 11,
	),
	array( // row #469
		'id' => 929204,
		'priemslot' => 12,
	),
	array( // row #470
		'id' => 929255,
		'priemslot' => 11,
	),
	array( // row #471
		'id' => 958124,
		'priemslot' => 12,
	),
	array( // row #472
		'id' => 899571,
		'priemslot' => 11,
	),
	array( // row #473
		'id' => 962392,
		'priemslot' => 14,
	),
	array( // row #474
		'id' => 931607,
		'priemslot' => 12,
	),
	array( // row #475
		'id' => 934883,
		'priemslot' => 13,
	),
	array( // row #476
		'id' => 937223,
		'priemslot' => 11,
	),
	array( // row #477
		'id' => 984027,
		'priemslot' => 11,
	),
	array( // row #478
		'id' => 968547,
		'priemslot' => 15,
	),
	array( // row #479
		'id' => 971181,
		'priemslot' => 13,
	),
	array( // row #480
		'id' => 997008,
		'priemslot' => 11,
	),
	array( // row #481
		'id' => 1030914,
		'priemslot' => 13,
	),
	array( // row #482
		'id' => 992470,
		'priemslot' => 12,
	),
	array( // row #483
		'id' => 987204,
		'priemslot' => 12,
	),
	array( // row #484
		'id' => 2094307,
		'priemslot' => 11,
	),
	array( // row #485
		'id' => 1030446,
		'priemslot' => 12,
	),
	array( // row #486
		'id' => 993295,
		'priemslot' => 11,
	),
	array( // row #487
		'id' => 1009556,
		'priemslot' => 14,
	),
	array( // row #488
		'id' => 1003920,
		'priemslot' => 13,
	),
	array( // row #489
		'id' => 1031856,
		'priemslot' => 11,
	),
	array( // row #490
		'id' => 1987994,
		'priemslot' => 14,
	),
	array( // row #491
		'id' => 1296882,
		'priemslot' => 12,
	),
	array( // row #492
		'id' => 1188707,
		'priemslot' => 11,
	),
	array( // row #493
		'id' => 1254630,
		'priemslot' => 12,
	),
	array( // row #494
		'id' => 1170483,
		'priemslot' => 12,
	),
	array( // row #495
		'id' => 1251883,
		'priemslot' => 12,
	),
	array( // row #496
		'id' => 1147287,
		'priemslot' => 14,
	),
	array( // row #497
		'id' => 1024312,
		'priemslot' => 12,
	),
	array( // row #498
		'id' => 1099159,
		'priemslot' => 12,
	),
	array( // row #499
		'id' => 1019772,
		'priemslot' => 11,
	),
	array( // row #500
		'id' => 1036499,
		'priemslot' => 13,
	),
	array( // row #501
		'id' => 1033389,
		'priemslot' => 12,
	),
	array( // row #502
		'id' => 1033400,
		'priemslot' => 13,
	),
	array( // row #503
		'id' => 1184713,
		'priemslot' => 12,
	),
	array( // row #504
		'id' => 1065182,
		'priemslot' => 12,
	),
	array( // row #505
		'id' => 1185298,
		'priemslot' => 11,
	),
	array( // row #506
		'id' => 1287411,
		'priemslot' => 14,
	),
	array( // row #507
		'id' => 1038244,
		'priemslot' => 11,
	),
	array( // row #508
		'id' => 1035593,
		'priemslot' => 11,
	),
	array( // row #509
		'id' => 1128801,
		'priemslot' => 12,
	),
	array( // row #510
		'id' => 1037840,
		'priemslot' => 12,
	),
	array( // row #511
		'id' => 1040313,
		'priemslot' => 12,
	),
	array( // row #512
		'id' => 1138343,
		'priemslot' => 11,
	),
	array( // row #513
		'id' => 1109927,
		'priemslot' => 11,
	),
	array( // row #514
		'id' => 1110417,
		'priemslot' => 11,
	),
	array( // row #515
		'id' => 1107368,
		'priemslot' => 11,
	),
	array( // row #516
		'id' => 1171433,
		'priemslot' => 13,
	),
	array( // row #517
		'id' => 1981582,
		'priemslot' => 11,
	),
	array( // row #518
		'id' => 1109353,
		'priemslot' => 11,
	),
	array( // row #519
		'id' => 1044102,
		'priemslot' => 13,
	),
	array( // row #520
		'id' => 1334630,
		'priemslot' => 12,
	),
	array( // row #521
		'id' => 1045415,
		'priemslot' => 11,
	),
	array( // row #522
		'id' => 1180782,
		'priemslot' => 12,
	),
	array( // row #523
		'id' => 1534872,
		'priemslot' => 12,
	),
	array( // row #524
		'id' => 1134392,
		'priemslot' => 12,
	),
	array( // row #525
		'id' => 1057662,
		'priemslot' => 12,
	),
	array( // row #526
		'id' => 1144090,
		'priemslot' => 13,
	),
	array( // row #527
		'id' => 1066136,
		'priemslot' => 12,
	),
	array( // row #528
		'id' => 1055015,
		'priemslot' => 11,
	),
	array( // row #529
		'id' => 1142612,
		'priemslot' => 12,
	),
	array( // row #530
		'id' => 1107337,
		'priemslot' => 12,
	),
	array( // row #531
		'id' => 1063785,
		'priemslot' => 11,
	),
	array( // row #532
		'id' => 1428228,
		'priemslot' => 11,
	),
	array( // row #533
		'id' => 1072759,
		'priemslot' => 11,
	),
	array( // row #534
		'id' => 1147827,
		'priemslot' => 12,
	),
	array( // row #535
		'id' => 1104906,
		'priemslot' => 11,
	),
	array( // row #536
		'id' => 1294176,
		'priemslot' => 11,
	),
	array( // row #537
		'id' => 1234095,
		'priemslot' => 11,
	),
	array( // row #538
		'id' => 1248940,
		'priemslot' => 12,
	),
	array( // row #539
		'id' => 1245487,
		'priemslot' => 13,
	),
	array( // row #540
		'id' => 1246053,
		'priemslot' => 11,
	),
	array( // row #541
		'id' => 1225524,
		'priemslot' => 11,
	),
	array( // row #542
		'id' => 1248190,
		'priemslot' => 11,
	),
	array( // row #543
		'id' => 1229160,
		'priemslot' => 11,
	),
	array( // row #544
		'id' => 1250212,
		'priemslot' => 12,
	),
	array( // row #545
		'id' => 1213803,
		'priemslot' => 12,
	),
	array( // row #546
		'id' => 1215125,
		'priemslot' => 11,
	),
	array( // row #547
		'id' => 1228264,
		'priemslot' => 12,
	),
	array( // row #548
		'id' => 1294343,
		'priemslot' => 11,
	),
	array( // row #549
		'id' => 1290409,
		'priemslot' => 11,
	),
	array( // row #550
		'id' => 1276338,
		'priemslot' => 13,
	),
	array( // row #551
		'id' => 1440142,
		'priemslot' => 11,
	),
	array( // row #552
		'id' => 1327946,
		'priemslot' => 13,
	),
	array( // row #553
		'id' => 1279181,
		'priemslot' => 11,
	),
	array( // row #554
		'id' => 1462906,
		'priemslot' => 11,
	),
	array( // row #555
		'id' => 1280051,
		'priemslot' => 11,
	),
	array( // row #556
		'id' => 1285848,
		'priemslot' => 12,
	),
	array( // row #557
		'id' => 1430466,
		'priemslot' => 12,
	),
	array( // row #558
		'id' => 1330147,
		'priemslot' => 11,
	),
	array( // row #559
		'id' => 1351523,
		'priemslot' => 12,
	),
	array( // row #560
		'id' => 1314022,
		'priemslot' => 11,
	),
	array( // row #561
		'id' => 1398761,
		'priemslot' => 12,
	),
	array( // row #562
		'id' => 1475343,
		'priemslot' => 12,
	),
	array( // row #563
		'id' => 1345767,
		'priemslot' => 12,
	),
	array( // row #564
		'id' => 1317981,
		'priemslot' => 12,
	),
	array( // row #565
		'id' => 1401635,
		'priemslot' => 11,
	),
	array( // row #566
		'id' => 1345248,
		'priemslot' => 11,
	),
	array( // row #567
		'id' => 1324345,
		'priemslot' => 12,
	),
	array( // row #568
		'id' => 1464084,
		'priemslot' => 11,
	),
	array( // row #569
		'id' => 1528372,
		'priemslot' => 12,
	),
	array( // row #570
		'id' => 1382812,
		'priemslot' => 14,
	),
	array( // row #571
		'id' => 1434160,
		'priemslot' => 13,
	),
	array( // row #572
		'id' => 1428389,
		'priemslot' => 11,
	),
	array( // row #573
		'id' => 1431522,
		'priemslot' => 12,
	),
	array( // row #574
		'id' => 1424524,
		'priemslot' => 11,
	),
	array( // row #575
		'id' => 1401809,
		'priemslot' => 11,
	),
	array( // row #576
		'id' => 1427842,
		'priemslot' => 11,
	),
	array( // row #577
		'id' => 1373700,
		'priemslot' => 12,
	),
	array( // row #578
		'id' => 1367722,
		'priemslot' => 11,
	),
	array( // row #579
		'id' => 1374243,
		'priemslot' => 12,
	),
	array( // row #580
		'id' => 1400509,
		'priemslot' => 13,
	),
	array( // row #581
		'id' => 1393535,
		'priemslot' => 13,
	),
	array( // row #582
		'id' => 1493476,
		'priemslot' => 11,
	),
	array( // row #583
		'id' => 1485369,
		'priemslot' => 11,
	),
	array( // row #584
		'id' => 1777565,
		'priemslot' => 11,
	),
	array( // row #585
		'id' => 1518222,
		'priemslot' => 11,
	),
	array( // row #586
		'id' => 1810854,
		'priemslot' => 11,
	),
	array( // row #587
		'id' => 1518069,
		'priemslot' => 11,
	),
	array( // row #588
		'id' => 1514373,
		'priemslot' => 11,
	),
	array( // row #589
		'id' => 1503937,
		'priemslot' => 13,
	),
	array( // row #590
		'id' => 1511227,
		'priemslot' => 11,
	),
	array( // row #591
		'id' => 1699931,
		'priemslot' => 11,
	),
	array( // row #592
		'id' => 1620649,
		'priemslot' => 11,
	),
	array( // row #593
		'id' => 1600264,
		'priemslot' => 12,
	),
	array( // row #594
		'id' => 1646057,
		'priemslot' => 11,
	),
	array( // row #595
		'id' => 1590024,
		'priemslot' => 11,
	),
	array( // row #596
		'id' => 1763433,
		'priemslot' => 11,
	),
	array( // row #597
		'id' => 1559609,
		'priemslot' => 11,
	),
	array( // row #598
		'id' => 1578658,
		'priemslot' => 11,
	),
	array( // row #599
		'id' => 1582479,
		'priemslot' => 13,
	),
	array( // row #600
		'id' => 1556221,
		'priemslot' => 11,
	),
	array( // row #601
		'id' => 1821624,
		'priemslot' => 12,
	),
	array( // row #602
		'id' => 1604912,
		'priemslot' => 12,
	),
	array( // row #603
		'id' => 1561395,
		'priemslot' => 11,
	),
	array( // row #604
		'id' => 1564771,
		'priemslot' => 11,
	),
	array( // row #605
		'id' => 1564462,
		'priemslot' => 12,
	),
	array( // row #606
		'id' => 1904087,
		'priemslot' => 11,
	),
	array( // row #607
		'id' => 1586856,
		'priemslot' => 11,
	),
	array( // row #608
		'id' => 1595762,
		'priemslot' => 11,
	),
	array( // row #609
		'id' => 1568182,
		'priemslot' => 12,
	),
	array( // row #610
		'id' => 1581840,
		'priemslot' => 11,
	),
	array( // row #611
		'id' => 1572033,
		'priemslot' => 11,
	),
	array( // row #612
		'id' => 1577639,

		'priemslot' => 13,
	),
	array( // row #613
		'id' => 1574955,
		'priemslot' => 11,
	),
	array( // row #614
		'id' => 1574170,
		'priemslot' => 11,
	),
	array( // row #615
		'id' => 2014614,
		'priemslot' => 11,
	),
	array( // row #616
		'id' => 1650167,
		'priemslot' => 11,
	),
	array( // row #617
		'id' => 1635462,
		'priemslot' => 12,
	),
	array( // row #618
		'id' => 1646671,
		'priemslot' => 11,
	),
	array( // row #619
		'id' => 1647823,
		'priemslot' => 11,
	),
	array( // row #620
		'id' => 1846640,
		'priemslot' => 11,
	),
	array( // row #621
		'id' => 1785248,
		'priemslot' => 12,
	),
	array( // row #622
		'id' => 1796075,
		'priemslot' => 12,
	),
	array( // row #623
		'id' => 1782913,
		'priemslot' => 12,
	),
	array( // row #624
		'id' => 1652266,
		'priemslot' => 11,
	),
	array( // row #625
		'id' => 1734890,
		'priemslot' => 12,
	),
	array( // row #626
		'id' => 1796490,
		'priemslot' => 11,
	),
	array( // row #627
		'id' => 1728302,
		'priemslot' => 11,
	),
	array( // row #628
		'id' => 1848756,
		'priemslot' => 11,
	),
	array( // row #629
		'id' => 1769214,
		'priemslot' => 12,
	),
	array( // row #630
		'id' => 1699010,
		'priemslot' => 12,
	),
	array( // row #631
		'id' => 1817432,
		'priemslot' => 12,
	),
	array( // row #632
		'id' => 1675836,
		'priemslot' => 12,
	),
	array( // row #633
		'id' => 1729439,
		'priemslot' => 12,
	),
	array( // row #634
		'id' => 1806824,
		'priemslot' => 11,
	),
	array( // row #635
		'id' => 1760026,
		'priemslot' => 11,
	),
	array( // row #636
		'id' => 1810639,
		'priemslot' => 11,
	),
	array( // row #637
		'id' => 1709194,
		'priemslot' => 16,
	),
	array( // row #638
		'id' => 1676519,
		'priemslot' => 11,
	),
	array( // row #639
		'id' => 1701052,
		'priemslot' => 12,
	),
	array( // row #640
		'id' => 1705737,
		'priemslot' => 12,
	),
	array( // row #641
		'id' => 1799464,
		'priemslot' => 11,
	),
	array( // row #642
		'id' => 1705973,
		'priemslot' => 12,
	),
	array( // row #643
		'id' => 1746928,
		'priemslot' => 11,
	),
	array( // row #644
		'id' => 1754441,
		'priemslot' => 12,
	),
	array( // row #645
		'id' => 1740442,
		'priemslot' => 11,
	),
	array( // row #646
		'id' => 1747199,
		'priemslot' => 11,
	),
	array( // row #647
		'id' => 1713500,
		'priemslot' => 11,
	),
	array( // row #648
		'id' => 1720180,
		'priemslot' => 11,
	),
	array( // row #649
		'id' => 1728686,
		'priemslot' => 11,
	),
	array( // row #650
		'id' => 1758847,
		'priemslot' => 11,
	),
	array( // row #651
		'id' => 1830492,
		'priemslot' => 11,
	),
	array( // row #652
		'id' => 1724200,
		'priemslot' => 12,
	),
	array( // row #653
		'id' => 1716396,
		'priemslot' => 11,
	),
	array( // row #654
		'id' => 1860055,
		'priemslot' => 12,
	),
	array( // row #655
		'id' => 1900695,
		'priemslot' => 11,
	),
	array( // row #656
		'id' => 1978103,
		'priemslot' => 12,
	),
	array( // row #657
		'id' => 2015578,
		'priemslot' => 13,
	),
	array( // row #658
		'id' => 1955156,
		'priemslot' => 11,
	),
	array( // row #659
		'id' => 2137373,
		'priemslot' => 11,
	),
	array( // row #660
		'id' => 2015260,
		'priemslot' => 12,
	),
	array( // row #661
		'id' => 2118209,
		'priemslot' => 12,
	),
	array( // row #662
		'id' => 1933400,
		'priemslot' => 12,
	),
	array( // row #663
		'id' => 1932132,
		'priemslot' => 11,
	),
	array( // row #664
		'id' => 2046584,
		'priemslot' => 11,
	),
	array( // row #665
		'id' => 2223345,
		'priemslot' => 12,
	),
	array( // row #666
		'id' => 1999693,
		'priemslot' => 13,
	),
	array( // row #667
		'id' => 1964727,
		'priemslot' => 11,
	),
	array( // row #668
		'id' => 2085010,
		'priemslot' => 11,
	),
	array( // row #669
		'id' => 2122692,
		'priemslot' => 12,
	),
	array( // row #670
		'id' => 2099054,
		'priemslot' => 11,
	),
	array( // row #671
		'id' => 2101579,
		'priemslot' => 12,
	),
	array( // row #672
		'id' => 2105818,
		'priemslot' => 11,
	),
	array( // row #673
		'id' => 2131346,
		'priemslot' => 11,
	),
	array( // row #674
		'id' => 2114572,
		'priemslot' => 11,
	),
	array( // row #675
		'id' => 2110456,
		'priemslot' => 11,
	),
	array( // row #676
		'id' => 2110539,
		'priemslot' => 11,
	),
	array( // row #677
		'id' => 2112245,
		'priemslot' => 12,
	),
	array( // row #678
		'id' => 2219165,
		'priemslot' => 11,
	),
	array( // row #679
		'id' => 2217851,
		'priemslot' => 12,
	),
	array( // row #680
		'id' => 2115746,
		'priemslot' => 11,
	),
	array( // row #681
		'id' => 2134692,
		'priemslot' => 11,
	),
	array( // row #682
		'id' => 2107277,
		'priemslot' => 11,
	),
	array( // row #683
		'id' => 2133768,
		'priemslot' => 14,
	),
	array( // row #684
		'id' => 2130827,
		'priemslot' => 12,
	),
	array( // row #685
		'id' => 2210107,
		'priemslot' => 11,
	),
	array( // row #686
		'id' => 2150679,
		'priemslot' => 12,
	),
	array( // row #687
		'id' => 2273351,
		'priemslot' => 13,
	),
	array( // row #688
		'id' => 2215383,
		'priemslot' => 11,
	),
	array( // row #689
		'id' => 2181124,
		'priemslot' => 12,
	),
	array( // row #690
		'id' => 2199206,
		'priemslot' => 11,
	),
	array( // row #691
		'id' => 2239295,
		'priemslot' => 11,
	),
	array( // row #692
		'id' => 2244535,
		'priemslot' => 12,
	),
	array( // row #693
		'id' => 2214517,
		'priemslot' => 11,
	),
	array( // row #694
		'id' => 2234112,
		'priemslot' => 11,
	),
	array( // row #695
		'id' => 2181889,
		'priemslot' => 12,
	),
	array( // row #696
		'id' => 2183141,
		'priemslot' => 11,
	),
	array( // row #697
		'id' => 2261053,
		'priemslot' => 11,
	),
	array( // row #698
		'id' => 2489973,
		'priemslot' => 11,
	),
	array( // row #699
		'id' => 2263751,
		'priemslot' => 11,
	),
	array( // row #700
		'id' => 2267986,
		'priemslot' => 11,
	),
	array( // row #701
		'id' => 2269703,
		'priemslot' => 11,
	),
	array( // row #702
		'id' => 2288011,
		'priemslot' => 11,
	),
	array( // row #703
		'id' => 2280267,
		'priemslot' => 11,
	),
	array( // row #704
		'id' => 2282632,
		'priemslot' => 11,
	),
	array( // row #705
		'id' => 2307096,
		'priemslot' => 11,
	),
	array( // row #706
		'id' => 2313708,
		'priemslot' => 11,
	),
	array( // row #707
		'id' => 2372835,
		'priemslot' => 11,
	),
	array( // row #708
		'id' => 2301873,
		'priemslot' => 12,
	),
	array( // row #709
		'id' => 2457038,
		'priemslot' => 11,
	),
	array( // row #710
		'id' => 2343488,
		'priemslot' => 11,
	),
	array( // row #711
		'id' => 2409478,
		'priemslot' => 12,
	),
	array( // row #712
		'id' => 2460090,
		'priemslot' => 11,
	),
	array( // row #713
		'id' => 2352703,
		'priemslot' => 12,
	),
	array( // row #714
		'id' => 2484204,
		'priemslot' => 11,
	),
	array( // row #715
		'id' => 2391019,
		'priemslot' => 11,
	),
	array( // row #716
		'id' => 2425606,
		'priemslot' => 11,
	),
	array( // row #717
		'id' => 2459558,
		'priemslot' => 11,
	),
	array( // row #718
		'id' => 2466045,
		'priemslot' => 11,
	),
	array( // row #719
		'id' => 2470834,
		'priemslot' => 11,
	),
	array( // row #720
		'id' => 2413413,
		'priemslot' => 11,
	),
	array( // row #721
		'id' => 2499093,
		'priemslot' => 11,
	),
);

if( isset($_GET['test']) ) {
	$i = 0;
	while( $i < count($stats) ) {
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$stats[$i]['id'].'" LIMIT 1'));
		$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$stats[$i]['id'].'" LIMIT 1'));
		$xz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `actions` WHERE `uid` = "'.$stats[$i]['id'].'" AND `vars` LIKE "%read%" LIMIT 1'));
		if( $usr['real'] > 0 && $stats[$i]['priemslot'] > $st['priemslot'] ) {
			mysql_query('UPDATE `stats` SET `priemslot` = "'.$stats[$i]['priemslot'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
			echo $usr['id'].' ( '.$usr['login'].' ) -> '.$stats[$i]['priemslot'].' , сейчас - '.$st['priemslot'].'<hr>';
		}
		$i++;
	}
	die();
}

$sp = mysql_query('SELECT * FROM `stats` WHERE `priemslot` > 10 AND `bot` = 0');
while( $pl = mysql_fetch_array($sp) ) {
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
	$xz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `actions` WHERE `uid` = "'.$pl['id'].'" AND `vars` LIKE "%read%" LIMIT 1'));
	if( $pl['priemslot']-$xz[0] > 10 && $xz[0] > 0 ) {
		echo ''.$usr['login'].'['.$usr['level'].'] - '.$pl['priemslot'].' - '.$xz[0].'<br>';		
	}
	if( $pl['priemslot'] == 10 && $xz[0] > 0 ) {
		echo '<font color=red>'.$usr['login'].'['.$usr['level'].'] - '.$pl['priemslot'].' - '.$xz[0].'</font><br>';
	}
}
?>